<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use App\Models\Product;
use App\Models\VoiceRecording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomizationController extends Controller
{
    public function store(Request $request)
    {
        // Validation rules for the incoming request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'required|string|in:pink,blue,yellow',
            'text' => 'nullable|string|max:20',
            'accessories' => 'nullable|array',
            'accessories.*' => 'in:bow-tie,heart,crown',
            'special_instructions' => 'nullable|string|max:255',
            'voice_recording_id' => 'nullable|exists:voice_recordings,id',
        ]);

        try {
            $userId = Auth::id();

            // If a voice recording is selected, ensure it belongs to the user
            if ($request->filled('voice_recording_id')) {
                $recording = VoiceRecording::where('id', $request->voice_recording_id)
                    ->where('user_id', $userId)
                    ->first();

                if (!$recording) {
                    return redirect()->back()->withErrors(['error' => 'Invalid voice recording selected.']);
                }
            }

            $customization = new Customization();
            $customization->user_id = $userId;
            $customization->product_id = $request->input('product_id');
            $customization->color = $request->input('color');
            $customization->text = $request->input('text');
            $customization->special_instructions = $request->input('special_instructions');
            $customization->voice_id = $request->input('voice_recording_id'); // Match this to the form field
            // Handle accessories - make sure we're getting the array properly
            $accessories = $request->input('accessories', []);
            $customization->accessories = !empty($accessories) ? json_encode($accessories) : json_encode([]);
            
            // For debugging
            \Log::info('Accessories submitted: ', ['accessories' => $accessories]);
            $customization->save();

            // Link customization to product (if customizable and belongs to the current user)
            $product = Product::find($customization->product_id);

            if ($product && $product->is_customizable && Auth::check()) {
                $product->customization_id = $customization->id;
                $product->save();
            }

            return redirect()->route('products.show')->with('success', 'Your bear has been customized and added to cart!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to save customization: ' . $e->getMessage()]);
        }
    }

    public function storeVoice(Request $request)
    {
        $request->validate([
            'voice_note' => 'required|file|mimes:mp3,wav,ogg|max:10240',
        ]);

        try {
            if ($request->hasFile('voice_note')) {
                $path = $request->file('voice_note')->store('voice_recording', 'public');

                $voiceRecording = new VoiceRecording();
                $voiceRecording->user_id = auth()->id();
                $voiceRecording->file_path = $path;
                $voiceRecording->save();

                return response()->json([
                    'message' => 'Voice recording uploaded successfully',
                    'recording_id' => $voiceRecording->id,
                ]);
            }

            return response()->json(['success' => false, 'message' => 'No voice recording file found.'], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error saving recording: ' . $e->getMessage()], 500);
        }
    }
}