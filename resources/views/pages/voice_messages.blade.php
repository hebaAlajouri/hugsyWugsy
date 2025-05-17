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
                        </div>
                    @else
                        <div class="voice-messages-container">
                            @foreach($voiceRecordings as $recording)
                                <div class="voice-message-card mb-4 p-3" style="background-color: #fff; border-radius: 15px; box-shadow: 0 4px 8px rgba(255, 182, 193, 0.2); border-left: 4px solid #ff99cc;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <span class="badge" style="background-color: #ffb6c1; color: #fff;">ID: {{ $recording->id }}</span>
                                        </div>
                                        <div>
                                            <small class="text-muted" style="font-family: 'Quicksand', sans-serif;"><i class="far fa-calendar-alt mr-1"></i> {{ $recording->created_at }}</small>
                                        </div>
                                    </div>
                                    
                                    <div class="audio-player-wrapper p-2" style="background-color: #fff3f6; border-radius: 12px;">
                                        <audio controls class="w-100" style="height: 40px;">
                                            <source src="{{ $recording->file_path }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>
                            @endforeach
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
</style>
@endsection