<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class VoiceRecordingController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Voice recording request received', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'headers' => $request->headers->all(),
            'has_file' => $request->hasFile('voice_note'),
            'all_files' => array_keys($request->allFiles()),
            'content_type' => $request->header('Content-Type')
        ]);

        // Check if file exists in request
        if (!$request->hasFile('voice_note')) {
            Log::error('No voice_note file in request', [
                'files' => $request->allFiles(),
                'input' => $request->all()
            ]);
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        try {
            $file = $request->file('voice_note');
            
            Log::info('File details', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'client_mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'is_valid' => $file->isValid(),
                'error' => $file->getError(),
                'path' => $file->path()
            ]);

            // Validate file
            if (!$file->isValid()) {
                Log::error('Invalid file upload', ['error_code' => $file->getError()]);
                return response()->json(['error' => 'Invalid file upload'], 422);
            }

            // Check file size (limit to 10MB)
            if ($file->getSize() > 10 * 1024 * 1024) {
                Log::warning('File too large', ['size' => $file->getSize()]);
                return response()->json(['error' => 'File too large (max 10MB)'], 422);
            }

            // Extended valid types for webm and wav
            $validTypes = [
                'audio/wav', 
                'audio/wave', 
                'audio/x-wav',
                'audio/webm',
                'audio/webm;codecs=opus',
                'audio/ogg',
                'audio/mpeg',
                'audio/mp3'
            ];
            
            $fileMimeType = $file->getMimeType();
            $clientMimeType = $file->getClientMimeType();
            
            if (!in_array($fileMimeType, $validTypes) && !in_array($clientMimeType, $validTypes)) {
                Log::warning('Invalid file type', [
                    'mime_type' => $fileMimeType,
                    'client_mime_type' => $clientMimeType,
                    'valid_types' => $validTypes
                ]);
                return response()->json(['error' => 'Invalid file type. Supported: WAV, WebM, OGG, MP3'], 422);
            }

            // Ensure directory exists
            if (!Storage::disk('public')->exists('voice_notes')) {
                Storage::disk('public')->makeDirectory('voice_notes');
                Log::info('Created voice_notes directory');
            }

            // Store the file
            $path = $file->store('voice_notes', 'public');
            Log::info('File stored successfully', ['path' => $path]);

            $fileSize = $file->getSize();
            $fileType = $file->getClientMimeType() ?: $file->getMimeType();
            $userId = Auth::check() ? Auth::id() : 1;

            Log::info('Preparing database insert', [
                'user_id' => $userId,
                'file_path' => $path,
                'file_size' => $fileSize,
                'file_type' => $fileType
            ]);

            // Test database connection first
            try {
                DB::connection()->getPdo();
                Log::info('Database connection successful');
            } catch (\Exception $e) {
                Log::error('Database connection failed', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Database connection failed'], 500);
            }

            // Check if voice_recordings table exists
            try {
                $tableExists = DB::getSchemaBuilder()->hasTable('voice_recordings');
                Log::info('Voice recordings table exists', ['exists' => $tableExists]);
                
                if (!$tableExists) {
                    Log::error('voice_recordings table does not exist');
                    return response()->json(['error' => 'Database table not found'], 500);
                }
            } catch (\Exception $e) {
                Log::error('Error checking table existence', ['error' => $e->getMessage()]);
            }

            // Insert into database with detailed logging
            try {
                $recordingId = DB::table('voice_recordings')->insertGetId([
                    'user_id' => $userId,
                    'file_path' => $path,
                    'file_size' => $fileSize,
                    'file_type' => $fileType,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Log::info('Database insert successful', [
                    'recording_id' => $recordingId,
                    'affected_rows' => 1
                ]);

                // Verify the record was actually inserted
                $record = DB::table('voice_recordings')->where('id', $recordingId)->first();
                Log::info('Record verification', ['record_found' => !!$record]);

                $fileUrl = Storage::url($path);
                Log::info('Returning success response', [
                    'recording_id' => $recordingId,
                    'file_url' => $fileUrl
                ]);

                return response()->json([
                    'message' => 'Recording saved successfully!',
                    'recording_id' => $recordingId,
                    'file_path' => $fileUrl,
                    'file_size' => $fileSize,
                    'file_type' => $fileType
                ]);

            } catch (\Exception $dbError) {
                Log::error('Database insert failed', [
                    'error' => $dbError->getMessage(),
                    'trace' => $dbError->getTraceAsString()
                ]);
                
                // Clean up uploaded file if database insert fails
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                    Log::info('Cleaned up uploaded file after database error');
                }
                
                return response()->json(['error' => 'Failed to save to database: ' . $dbError->getMessage()], 500);
            }

        } catch (\Exception $e) {
            Log::error('General error in voice recording upload', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to save recording: ' . $e->getMessage()], 500);
        }
    }

    // Add a test method to verify database connectivity
    public function test()
    {
        try {
            // Test database connection
            $pdo = DB::connection()->getPdo();
            Log::info('Database PDO connection successful');

            // Test table existence
            $tableExists = DB::getSchemaBuilder()->hasTable('voice_recordings');
            Log::info('Table check', ['voice_recordings_exists' => $tableExists]);

            // Test insert (you can remove this after testing)
            $testId = DB::table('voice_recordings')->insertGetId([
                'user_id' => 1,
                'file_path' => 'test/path.wav',
                'file_size' => 1024,
                'file_type' => 'audio/wav',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('Test insert successful', ['test_id' => $testId]);

            // Clean up test record
            DB::table('voice_recordings')->where('id', $testId)->delete();

            return response()->json([
                'message' => 'Database test successful',
                'table_exists' => $tableExists,
                'test_insert_id' => $testId
            ]);

        } catch (\Exception $e) {
            Log::error('Database test failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $userId = Auth::id();
        
        $voiceRecordings = DB::table('voice_recordings')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($recording) {
                // Convert the stored file path to a full URL
                $recording->file_url = Storage::url($recording->file_path);
                
                // Format the created_at date for better display
                $recording->formatted_date = Carbon::parse($recording->created_at)->format('M j, Y g:i A');
                
                // Add file size in human readable format
                $recording->file_size_human = $this->formatBytes($recording->file_size ?? 0);
                
                return $recording;
            });
        
        return view('pages.voice_messages', compact('voiceRecordings'));
    }
    
    // Helper method to format file size
    private function formatBytes($size, $precision = 2)
    {
        if ($size == 0) return '0 B';
        
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB'];
        
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}
