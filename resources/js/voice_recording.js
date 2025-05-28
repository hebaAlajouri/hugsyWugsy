// voice_recording.js - Debug version with detailed logging
let mediaRecorder;
let audioChunks = [];
let recordedBlob = null;

document.addEventListener('DOMContentLoaded', function() {
    console.log('Voice recording script loaded');
    
    const recordBtn = document.getElementById('record-btn');
    const stopBtn = document.getElementById('stop-btn');
    const playBtn = document.getElementById('play-btn');
    const saveBtn = document.querySelector('.save-btn');
    const form = document.getElementById('voice-recording-form');

    // Check if all elements exist
    console.log('Elements found:', {
        recordBtn: !!recordBtn,
        stopBtn: !!stopBtn,
        playBtn: !!playBtn,
        saveBtn: !!saveBtn,
        form: !!form
    });

    if (!recordBtn || !stopBtn || !playBtn || !saveBtn || !form) {
        console.error('Some required elements are missing from the DOM');
        return;
    }

    // Record button click handler
    recordBtn.addEventListener('click', async function() {
        console.log('Record button clicked');
        
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ 
                audio: {
                    echoCancellation: true,
                    noiseSuppression: true,
                    sampleRate: 44100
                } 
            });
            
            console.log('Media stream obtained:', stream);
            
            // Reset audio chunks
            audioChunks = [];
            
            mediaRecorder = new MediaRecorder(stream, {
                mimeType: 'audio/webm;codecs=opus' // Explicitly set mime type
            });
            
            console.log('MediaRecorder created with mimeType:', mediaRecorder.mimeType);
            
            mediaRecorder.ondataavailable = function(event) {
                console.log('Data available:', event.data.size, 'bytes');
                if (event.data.size > 0) {
                    audioChunks.push(event.data);
                }
            };
            
            mediaRecorder.onstop = function() {
                console.log('Recording stopped. Total chunks:', audioChunks.length);
                
                if (audioChunks.length > 0) {
                    recordedBlob = new Blob(audioChunks, { type: 'audio/webm' });
                    console.log('Blob created:', recordedBlob.size, 'bytes');
                    
                    // Enable play and save buttons
                    playBtn.disabled = false;
                    saveBtn.disabled = false;
                    
                    // Stop all tracks to release the microphone
                    stream.getTracks().forEach(track => track.stop());
                } else {
                    console.error('No audio chunks recorded');
                }
            };
            
            mediaRecorder.onerror = function(event) {
                console.error('MediaRecorder error:', event.error);
            };
            
            mediaRecorder.start();
            console.log('Recording started');
            
            // Update UI
            recordBtn.disabled = true;
            stopBtn.disabled = false;
            
        } catch (error) {
            console.error('Error accessing microphone:', error);
            alert('Could not access microphone. Please check permissions.');
        }
    });

    // Stop button click handler
    stopBtn.addEventListener('click', function() {
        console.log('Stop button clicked');
        
        if (mediaRecorder && mediaRecorder.state === 'recording') {
            mediaRecorder.stop();
            console.log('MediaRecorder stopped');
            
            // Update UI
            recordBtn.disabled = false;
            stopBtn.disabled = true;
        }
    });

    // Play button click handler
    playBtn.addEventListener('click', function() {
        console.log('Play button clicked');
        
        if (recordedBlob) {
            const audio = new Audio();
            audio.src = URL.createObjectURL(recordedBlob);
            audio.play().catch(error => {
                console.error('Error playing audio:', error);
            });
        }
    });

    // Save button click handler
    saveBtn.addEventListener('click', function() {
        console.log('Save button clicked');
        
        if (!recordedBlob) {
            console.error('No recording to save');
            alert('Please record something first!');
            return;
        }

        console.log('Preparing to upload blob:', recordedBlob.size, 'bytes, type:', recordedBlob.type);

        const formData = new FormData();
        
        // Create a file from the blob with proper extension
        const file = new File([recordedBlob], 'voice_note.webm', { 
            type: 'audio/webm' 
        });
        
        formData.append('voice_note', file);
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found');
            alert('CSRF token missing. Please refresh the page.');
            return;
        }

        console.log('CSRF token found:', csrfToken.getAttribute('content'));

        // Disable save button during upload
        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';

        fetch('/voice-recordings', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', [...response.headers.entries()]);
            
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Server error response:', text);
                    throw new Error(`HTTP ${response.status}: ${text}`);
                });
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Success response:', data);
            alert('Recording saved successfully!');
            
            // Reset the form
            audioChunks = [];
            recordedBlob = null;
            playBtn.disabled = true;
            saveBtn.disabled = true;
            saveBtn.textContent = '💜 Save Recording';
        })
        .catch(error => {
            console.error('Upload error:', error);
            alert('Failed to save recording: ' + error.message);
            
            // Re-enable save button
            saveBtn.disabled = false;
            saveBtn.textContent = '💜 Save Recording';
        });
    });
});