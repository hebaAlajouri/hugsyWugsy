@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-lg" style="background-color: #fff8fa; border: 2px solid #ffcce6;">
                <div class="card-header text-center py-4" style="background-color: #ffcce6; border-bottom: none;">
                    <h2 class="mb-0" style="font-family: 'Quicksand', sans-serif; color: #d6568c; font-weight: 600;">
                        <i class="fas fa-microphone-alt mr-2"></i> My Bear Messages
                    </h2>
                </div>
                
                <div class="card-body p-4">
                    @if($voiceRecordings->isEmpty())
                        <div class="text-center py-5">
                            <img src="/api/placeholder/200/200" alt="Empty messages illustration" class="mb-4" />
                            <p class="text-muted" style="font-family: 'Quicksand', sans-serif; font-size: 1.1rem; color: #d6568c;">
                                You haven't added any voice messages yet.
                            </p>
                            <a href="#" class="btn mt-3 px-4 py-2" style="background-color: #ffcce6; color: #d6568c; border-radius: 25px; font-weight: 600;">
                                <i class="fas fa-microphone mr-2"></i> Record Your First Message
                            </a>
                        </div>
                    @else
                        <div class="voice-messages-container">
                            @foreach($voiceRecordings as $recording)
                                <div class="voice-message-card mb-4 p-3" style="background-color: #fff; border-radius: 15px; box-shadow: 0 4px 8px rgba(255, 182, 193, 0.2); border-left: 4px solid #ff99cc;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <span class="badge" style="background-color: #ffb6c1; color: #fff;">Message #{{ $recording->id }}</span>
                                            @if(isset($recording->file_size_human))
                                                <span class="badge ml-2" style="background-color: #e6f3ff; color: #0066cc;">{{ $recording->file_size_human }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <small class="text-muted" style="font-family: 'Quicksand', sans-serif;">
                                                <i class="far fa-calendar-alt mr-1"></i> 
                                                {{ isset($recording->formatted_date) ? $recording->formatted_date : $recording->created_at }}
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <div class="audio-player-wrapper p-2" style="background-color: #fff3f6; border-radius: 12px;">
                                        <audio controls class="w-100" style="height: 40px;" preload="metadata">
                                            <source src="{{ $recording->file_url ?? Storage::url($recording->file_path) }}" type="{{ $recording->file_type ?? 'audio/webm' }}">
                                            <source src="{{ $recording->file_url ?? Storage::url($recording->file_path) }}" type="audio/mpeg">
                                            <source src="{{ $recording->file_url ?? Storage::url($recording->file_path) }}" type="audio/wav">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                    
                                    <!-- Debug info (remove in production) -->
                             
                                    
                                    <!-- Action buttons -->
                                    <div class="mt-3 text-right">
                                        <a href="{{ $recording->file_url ?? Storage::url($recording->file_path) }}" 
                                           download="voice_message_{{ $recording->id }}.{{ pathinfo($recording->file_path, PATHINFO_EXTENSION) }}"
                                           class="btn btn-sm mr-2" 
                                           style="background-color: #e6f7ff; color: #0066cc; border-radius: 15px;">
                                            <i class="fas fa-download mr-1"></i> Download
                                        </a>
                                        <button class="btn btn-sm" 
                                                style="background-color: #ffe6e6; color: #cc0000; border-radius: 15px;"
                                                onclick="deleteRecording({{ $recording->id }})">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Add new recording button -->
                        <div class="text-center mt-4">
                            <a href="#" class="btn px-4 py-2" style="background-color: #ffcce6; color: #d6568c; border-radius: 25px; font-weight: 600;">
                                <i class="fas fa-plus mr-2"></i> Add New Message
                            </a>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer text-center py-3" style="background-color: #fff8fa; border-top: none;">
                    <a href="{{ url()->previous() }}" class="btn px-4 py-2" style="background-color: #ffcce6; color: #d6568c; border-radius: 25px; font-weight: 600; box-shadow: 0 3px 6px rgba(0,0,0,0.1);">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Adding feminine font family */
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap');
    
    body {
        background-color: #fff0f5;
        font-family: 'Quicksand', sans-serif;
    }
    
    .container {
        max-width: 900px;
    }
    
    .voice-message-card:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
        box-shadow: 0 6px 12px rgba(255, 182, 193, 0.3);
    }
    
    audio::-webkit-media-controls-panel {
        background-color: #ffecf2;
    }
    
    audio::-webkit-media-controls-play-button {
        background-color: #ff99cc;
        border-radius: 50%;
    }
    
    .btn:hover {
        background-color: #ffb6c1 !important;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    /* Better audio player styling */
    audio {
        border-radius: 8px;
        outline: none;
    }
    
    audio:focus {
        outline: 2px solid #ff99cc;
    }
</style>

<script>
function deleteRecording(recordingId) {
    if (confirm('Are you sure you want to delete this voice message? This action cannot be undone.')) {
        fetch(`/voice-recordings/${recordingId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete recording: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete recording');
        });
    }
}
</script>
@endsection