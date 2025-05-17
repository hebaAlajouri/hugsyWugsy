@extends('layouts.app')  

@section('title', 'Record a Message | HugsyWugsy')  

@section('content') 
<link rel="stylesheet" href="{{ asset('css/voice_recording.css') }}"> 
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/voice_recording.js') }}" defer></script> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Pacifico&display=swap" rel="stylesheet">  

<div class="container">     
    <h1>Make Your Teddy Bear Magical! ✨</h1>     
    <p>Record a sweet message or cute phrase, and add a personal touch to your cuddly friend!</p>      
    
    <div class="recording-box">         
        <img src="{{ asset('images/record.jpeg') }}" alt="Teddy Bear" class="teddy-image">         
        <button id="record-btn" class="record-btn">🎤</button>         
        <div class="waveform" id="waveform"></div>         
        <div class="controls">             
            <button id="stop-btn" class="stop-btn" disabled>⏹ Stop</button>             
            <button id="play-btn" class="play-btn" disabled>▶ Play</button>         
        </div>     
    </div>      
    
    <div class="message-ideas">         
        <span class="message">"I love you!"</span>         
        <span class="message">"Hug me tight!"</span>         
        <span class="message">"Sweet dreams!"</span>     
    </div>      

    <div class="upload-section">         
        <h2 class="mt-4">Save Your Recording</h2>                  
        <form id="voice-recording-form">             
            @csrf             
            <button type="button" class="save-btn" disabled>💜 Save Recording</button>         
        </form>                  
       

    </div> 
    
</div>


@endsection
