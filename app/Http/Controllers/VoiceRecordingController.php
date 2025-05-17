<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoiceRecordingController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Voice recording request received');

        if (!$request->hasFile('voice_note')) {
            Log::error('No voice_note file in request');
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        try {
            $file = $request->file('voice_note');

            $validTypes = ['audio/wav', 'audio/wave', 'audio/x-wav', 'audio/webm'];
            if (!in_array($file->getMimeType(), $validTypes) && !in_array($file->getClientMimeType(), $validTypes)) {
                Log::warning('Invalid file type: ' . $file->getMimeType());
                return response()->json(['error' => 'Invalid file type'], 422);
            }

            $path = $file->store('voice_notes', 'public');
            Log::info('File saved to: ' . $path);

            $fileSize = $file->getSize();
            $fileType = $file->getClientMimeType();
            $userId = Auth::check() ? Auth::id() : 1;

            $recordingId = DB::table('voice_recordings')->insertGetId([
                'user_id' => $userId,
                'file_path' => $path,
                'file_size' => $fileSize,
                'file_type' => $fileType,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'message' => 'Recording saved!',
                'recording_id' => $recordingId,
                'file_path' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving voice recording: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to save recording'], 500);
        }
    }

    public function index()
    {
        $userId = Auth::id();

        $voiceRecordings = DB::table('voice_recordings')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.voice_messages', compact('voiceRecordings'));
    }
}
