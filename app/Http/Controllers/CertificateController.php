<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use Carbon\Carbon;

class CertificateController extends Controller
{
    public function index()
    {
        $latestCertificate = Certificate::latest()->first();
        
        return view('pages.certificate', [
            'owner_name' => $latestCertificate->owner_name ?? 'Sarah Johnson',
            'bear_name' => $latestCertificate->bear_name ?? 'Mr. Snuggles',
            'adoption_date' => $latestCertificate ? $latestCertificate->adoption_date->format('F j, Y') : 'March 14, 2025',
            'raw_date' => $latestCertificate ? $latestCertificate->adoption_date->format('Y-m-d') : Carbon::now()->format('Y-m-d')
        ]);
    }
    
    public function generate(Request $request)
    {
        $request->validate([
            'owner_name' => 'required|string|max:255',
            'bear_name' => 'required|string|max:255',
            'adoption_date' => 'required|date'
        ]);
        
        $certificate = Certificate::create([
            'owner_name' => $request->owner_name,
            'bear_name' => $request->bear_name,
            'adoption_date' => $request->adoption_date
        ]);
        
        return redirect()->route('pages.certificate')->with('success', 'Certificate has been updated successfully!');
    }
    ////////////////////////
//     <?php

// namespace App\Http\Controllers;

// use App\Models\Certificate;
// use Illuminate\Http\Request;

// class CertificateController extends Controller
// {
//     public function index() {
//         $certificates = Certificate::all();
//         return view('certificates.index', compact('certificates'));
//     }

//     public function create() {
//         return view('certificates.create');
//     }

//     public function store(Request $request) {
//         Certificate::create($request->all());
//         return redirect()->route('certificates.index');
//     }

//     public function edit(Certificate $certificate) {
//         return view('certificates.edit', compact('certificate'));
//     }

//     public function update(Request $request, Certificate $certificate) {
//         $certificate->update($request->all());
//         return redirect()->route('certificates.index');
//     }

//     public function destroy(Certificate $certificate) {
//         $certificate->delete();
//         return redirect()->route('certificates.index');
//     }
// }

}
