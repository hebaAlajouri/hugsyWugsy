<?php
namespace App\Http\Controllers;

use App\Models\BearCertificate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BearCertificateController extends Controller
{
    /**
     * Apply auth middleware to all methods except view (for sharing)
     */
    public function __construct()
    {
        // This will apply 'auth' middleware to all methods
        $this->middleware('auth');

        // OR apply only to specific methods
        // $this->middleware('auth')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display the certificate page for the authenticated user
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        
        // Get user's current/latest certificate
        $certificate = $user->bearCertificates()->latest()->first();
        
        // Prepare data for the view
        $data = [
            'user' => $user,
            'certificates' => $user->activeBearCertificates()->latest()->get(), // All active certificates
        ];
        
        if ($certificate) {
            $data = array_merge($data, [
                'owner_name' => $certificate->owner_name,
                'bear_name' => $certificate->bear_name,
                'adoption_date' => $certificate->formatted_adoption_date,
                'raw_date' => $certificate->raw_adoption_date,
                'certificate_number' => $certificate->certificate_number,
                'certificate' => $certificate
            ]);
        } else {
            // Default values for new users
            $data = array_merge($data, [
                'owner_name' => $user->name, // Use authenticated user's name as default
                'bear_name' => 'Mr. Snuggles',
                'adoption_date' => Carbon::now()->format('F j, Y'),
                'raw_date' => Carbon::now()->format('Y-m-d')
            ]);
        }
        
        return view('pages.certificate', $data);
    }

    /**
     * Generate/Create new certificate for authenticated user
     */
    public function generate(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        // Validate the request
        $validated = $request->validate([
            'owner_name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z\s\-\.\']+$/'
            ],
            'bear_name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z0-9\s\-\.\']+$/',
                // Check if user already has a bear with this name
                'unique:bear_certificates,bear_name,NULL,id,user_id,' . $user->id . ',is_active,1'
            ],
            'adoption_date' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . Carbon::now()->subYears(10)->format('Y-m-d')
            ]
        ], [
            'owner_name.required' => 'Please enter your name.',
            'owner_name.regex' => 'Name can only contain letters, spaces, hyphens, dots, and apostrophes.',
            'owner_name.min' => 'Name must be at least 2 characters long.',
            'bear_name.required' => 'Please enter your teddy bear\'s name.',
            'bear_name.regex' => 'Bear name can only contain letters, numbers, spaces, hyphens, dots, and apostrophes.',
            'bear_name.min' => 'Bear name must be at least 2 characters long.',
            'bear_name.unique' => 'You already have an active certificate for a bear with this name. Please choose a different name.',
            'adoption_date.required' => 'Please select an adoption date.',
            'adoption_date.before_or_equal' => 'Adoption date cannot be in the future.',
            'adoption_date.after_or_equal' => 'Adoption date seems too old. Please check the date.'
        ]);

        try {
            // Create new certificate for the authenticated user
            $certificate = $user->bearCertificates()->create($validated);

            $message = 'Congratulations! Your bear adoption certificate for ' . $certificate->bear_name . ' has been created! 🎉🐻';

            return redirect()->route('pages.certificate.index')
                           ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->withErrors(['error' => 'Something went wrong while creating your certificate. Please try again.']);
        }
    }

    /**
     * Update an existing certificate
     */
    public function update(Request $request, BearCertificate $certificate): RedirectResponse
    {
        $user = Auth::user();
        
        // Check if certificate belongs to the authenticated user
        if (!$certificate->belongsToUser($user->id)) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $validated = $request->validate([
            'owner_name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z\s\-\.\']+$/'
            ],
            'bear_name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z0-9\s\-\.\']+$/',
                // Check uniqueness excluding current certificate
                'unique:bear_certificates,bear_name,' . $certificate->id . ',id,user_id,' . $user->id . ',is_active,1'
            ],
            'adoption_date' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . Carbon::now()->subYears(10)->format('Y-m-d')
            ]
        ], [
            'bear_name.unique' => 'You already have another active certificate for a bear with this name. Please choose a different name.',
        ]);

        try {
            $certificate->update($validated);
            
            $message = 'Your bear adoption certificate for ' . $certificate->bear_name . ' has been updated successfully! 🐻💕';

            return redirect()->route('pages.certificate.index')
                           ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->withErrors(['error' => 'Something went wrong while updating your certificate. Please try again.']);
        }
    }

    /**
     * Show all certificates for the authenticated user
     */
    public function myBears(): View
    {
        $user = Auth::user();
        $certificates = $user->bearCertificates()->latest()->paginate(12);
        
        return view('pages.my-bears', compact('certificates', 'user'));
    }

    /**
     * Deactivate a certificate (soft delete)
     */
    public function deactivate(BearCertificate $certificate): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$certificate->belongsToUser($user->id)) {
            abort(403, 'Unauthorized action.');
        }

        $certificate->update(['is_active' => false]);
        
        return redirect()->back()
                       ->with('success', 'Certificate for ' . $certificate->bear_name . ' has been deactivated.');
    }

    /**
     * Reactivate a certificate
     */
    public function reactivate(BearCertificate $certificate): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$certificate->belongsToUser($user->id)) {
            abort(403, 'Unauthorized action.');
        }

        $certificate->update(['is_active' => true]);
        
        return redirect()->back()
                       ->with('success', 'Certificate for ' . $certificate->bear_name . ' has been reactivated.');
    }

    /**
     * Show a specific certificate for editing
     */
    public function edit(BearCertificate $certificate): View
    {
        $user = Auth::user();
        
        if (!$certificate->belongsToUser($user->id)) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.certificate', [
            'user' => $user,
            'certificate' => $certificate,
            'owner_name' => $certificate->owner_name,
            'bear_name' => $certificate->bear_name,
            'adoption_date' => $certificate->formatted_adoption_date,
            'raw_date' => $certificate->raw_adoption_date,
            'certificate_number' => $certificate->certificate_number,
            'is_editing' => true
        ]);
    }

    /**
     * View a shared certificate (public access)
     */
    public function view(string $certificateNumber): View
    {
        $certificate = BearCertificate::where('certificate_number', $certificateNumber)
                                    ->where('is_active', true)
                                    ->firstOrFail();
        
        return view('pages.certificate-view', [
            'certificate' => $certificate,
            'owner_name' => $certificate->owner_name,
            'bear_name' => $certificate->bear_name,
            'adoption_date' => $certificate->formatted_adoption_date,
            'certificate_number' => $certificate->certificate_number,
            'is_shared_view' => true
        ]);
    }

    /**
     * Download certificate as image
     */
    public function download(BearCertificate $certificate)
    {
        $user = Auth::user();
        
        if (!$certificate->belongsToUser($user->id)) {
            abort(403, 'Unauthorized action.');
        }

        // For now, redirect back with message
        return redirect()->back()
                       ->with('info', 'Download feature coming soon! For now, use your browser\'s screenshot feature. 📸');
    }

    /**
     * Get sharing URL for certificate
     */
    public function getShareUrl(BearCertificate $certificate)
    {
        $user = Auth::user();
        
        if (!$certificate->belongsToUser($user->id)) {
            abort(403, 'Unauthorized action.');
        }

        $shareUrl = route('pages.certificate.view', $certificate->certificate_number);
        
        return response()->json([
            'share_url' => $shareUrl,
            'message' => 'Share this link to show off your bear adoption certificate!'
        ]);
    }

    /**
     * Dashboard stats for user
     */
    public function userStats()
    {
        $user = Auth::user();
        
        return [
            'total_bears' => $user->bearCertificates()->count(),
            'active_bears' => $user->activeBearCertificates()->count(),
            'newest_bear' => $user->bearCertificates()->latest()->first()?->bear_name,
            'adoption_anniversary' => $user->bearCertificates()->oldest()->first()?->adoption_date
        ];
    }
}

