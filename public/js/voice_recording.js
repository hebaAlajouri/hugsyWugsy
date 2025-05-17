// 🎤 Recording setup
let mediaRecorder;
let audioChunks = [];
let audioBlob; // Store the recorded audio blob

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Determine the correct endpoint for voice recording storage
    const voiceRecordingUrl = "/pages/voice_recording/store";  // Updated with correct endpoint
    
    // Make sure all elements exist before adding event listeners
    const recordBtn = document.getElementById("record-btn");
    const stopBtn = document.getElementById("stop-btn");
    const playBtn = document.getElementById("play-btn");
    const saveBtn = document.querySelector(".save-btn");
    
    if (recordBtn) recordBtn.addEventListener("click", startRecording);
    if (stopBtn) stopBtn.addEventListener("click", stopRecording);
    if (playBtn) playBtn.addEventListener("click", playRecording);
    
    // Start recording function
    function startRecording() {
        audioChunks = []; // Clear any previous recording chunks
    
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.start();
                
                const waveform = document.getElementById("waveform");
                if (waveform) waveform.style.opacity = "1";  // Visual indicator for recording
    
                mediaRecorder.ondataavailable = event => {
                    audioChunks.push(event.data);
                };
    
                mediaRecorder.onstop = () => {
                    // Create a blob once recording is stopped
                    audioBlob = new Blob(audioChunks, { type: "audio/wav" });
                    // Enable save button after recording is done
                    if (saveBtn) saveBtn.disabled = false;
                };
    
                // Update UI for recording state
                if (recordBtn) recordBtn.disabled = true;
                if (stopBtn) stopBtn.disabled = false;
                if (playBtn) playBtn.disabled = true;
            })
            .catch(err => {
                console.error("Microphone access denied:", err);
                alert("Please allow microphone access to record your voice message.");
            });
    }
    
    // Stop recording function
    function stopRecording() {
        if (mediaRecorder && mediaRecorder.state !== "inactive") {
            mediaRecorder.stop();
            // Stop all tracks in the stream to release the microphone
            mediaRecorder.stream.getTracks().forEach(track => track.stop());
        }
        
        const waveform = document.getElementById("waveform");
        if (waveform) waveform.style.opacity = "0.2"; // Visual feedback for stopped recording
    
        // Update UI for stopped state
        if (recordBtn) recordBtn.disabled = false;
        if (stopBtn) stopBtn.disabled = true;
        if (playBtn) playBtn.disabled = false;
    }
    
    // Play the recorded audio
    function playRecording() {
        if (audioBlob) {
            const audioUrl = URL.createObjectURL(audioBlob);
            const audio = new Audio(audioUrl);
            audio.play();
        } else {
            alert("Please record something first.");
        }
    }
    
    // 💾 Save Recording and upload to the server
    if (saveBtn) {
        saveBtn.addEventListener("click", function(event) {
            event.preventDefault();  // Prevent default form submission
            
            if (!audioBlob) {
                alert("Please record your voice before saving.");
                return;
            }
    
            // Create a FormData object to send the recording
            let formData = new FormData();
            formData.append('voice_note', audioBlob, 'voice_note.wav'); // Append recorded audio file
            formData.append('_token', csrfToken); // Add CSRF token
    
            // Console log for debugging
            console.log("Submitting to URL:", voiceRecordingUrl);
    
            // Show loading state
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = "Saving...";
            saveBtn.disabled = true;
    
            // Send the recording via fetch
            fetch(voiceRecordingUrl, {
                method: 'POST',  // Ensure this is a POST request
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    // Don't set Content-Type header when using FormData - browser sets it automatically with boundary
                },
                credentials: 'same-origin' // Include cookies for CSRF
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log("Upload successful:", data);
                alert('🎉 Your recording has been saved!');
    
                // Reset UI
                if (data.recording_id) {
                    const recordingIdInput = document.getElementById("recording_id");
                    if (recordingIdInput) recordingIdInput.value = data.recording_id;
                }
    
                // Reset the state for the next recording
                audioBlob = null;
                audioChunks = [];
                if (playBtn) playBtn.disabled = true;
            })
            .catch(error => {
                console.error('Error uploading file:', error);
                alert('Failed to save recording. Please try again.');
            })
            .finally(() => {
                saveBtn.innerHTML = originalText;  // Reset button text
                saveBtn.disabled = false;  // Enable the button again
            });
        });
    }
});