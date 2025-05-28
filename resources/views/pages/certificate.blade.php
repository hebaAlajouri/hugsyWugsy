@extends('layouts.app2')

@section('title', 'Bear Adoption Certificate')

@section('content')
<style>
    /* Feminine and Girly Styling */
    body {
        background: linear-gradient(135deg, #ffeef8 0%, #f8e8ff 50%, #fff0f8 100%);
        font-family: 'Georgia', 'Times New Roman', serif;
        min-height: 100vh;
    }

    .container {
        position: relative;
    }

    .container::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 20%, rgba(255, 182, 193, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(221, 160, 221, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 60%, rgba(255, 240, 245, 0.1) 0%, transparent 50%);
        pointer-events: none;
        z-index: -1;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid #f8d7da;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(255, 182, 193, 0.3);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle at 30% 20%, rgba(255, 182, 193, 0.05) 0%, transparent 30%),
            radial-gradient(circle at 70% 80%, rgba(221, 160, 221, 0.05) 0%, transparent 30%);
        animation: shimmer 6s ease-in-out infinite alternate;
        pointer-events: none;
    }

    @keyframes shimmer {
        0% { transform: rotate(0deg) scale(1); }
        100% { transform: rotate(2deg) scale(1.02); }
    }

    .card-body {
        position: relative;
        z-index: 1;
        padding: 2rem;
    }

    .card-title {
        color: #d63384;
        font-family: 'Brush Script MT', cursive;
        text-shadow: 2px 2px 4px rgba(255, 182, 193, 0.3);
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .card-text {
        color: #8e4162;
        font-style: italic;
        font-size: 1.1rem;
    }

    .form-label {
        color: #d63384;
        font-weight: 600;
        font-size: 1.1rem;
        text-shadow: 1px 1px 2px rgba(255, 182, 193, 0.2);
    }

    .form-control {
        border: 2px solid #f8d7da;
        border-radius: 15px;
        padding: 12px 16px;
        background: rgba(255, 240, 245, 0.8);
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #e83e8c;
        box-shadow: 0 0 0 0.2rem rgba(232, 62, 140, 0.25);
        background: rgba(255, 240, 245, 1);
        transform: translateY(-2px);
    }

    .btn-success {
        background: linear-gradient(45deg, #e83e8c, #d63384);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(232, 62, 140, 0.3);
    }

    .btn-success:hover {
        background: linear-gradient(45deg, #d63384, #c2185b);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(232, 62, 140, 0.4);
    }

    .btn-info {
        background: linear-gradient(45deg, #da70d6, #dda0dd);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(218, 112, 214, 0.3);
    }

    .btn-info:hover {
        background: linear-gradient(45deg, #d63384, #da70d6);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(218, 112, 214, 0.4);
    }

    /* Certificate Styling */
    #certificate {
        background: linear-gradient(135deg, #fff0f8 0%, #ffeef8 50%, #fff5f8 100%);
        border: 3px solid #f8d7da;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }

    #certificate::before {
        content: '';
        position: absolute;
        top: 10px;
        left: 10px;
        right: 10px;
        bottom: 10px;
        border: 2px dashed #e83e8c;
        border-radius: 15px;
        pointer-events: none;
    }

    #certificate::after {
        content: '💖 ✨ 🌸 💕 🦋 💖 ✨ 🌸 💕 🦋';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 1.2rem;
        opacity: 0.3;
        animation: sparkle 3s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes sparkle {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.05); }
    }

    .certificate-logo {
        border-radius: 50%;
        border: 3px solid #f8d7da;
        box-shadow: 0 4px 15px rgba(255, 182, 193, 0.4);
        transition: transform 0.3s ease;
    }

    .certificate-logo:hover {
        transform: scale(1.1) rotate(5deg);
    }

    .fancy-title {
        color: #d63384;
        font-family: 'Brush Script MT', cursive;
        font-size: 2.5rem;
        text-shadow: 3px 3px 6px rgba(255, 182, 193, 0.4);
        margin: 1rem 0;
        position: relative;
    }

    .fancy-title::before,
    .fancy-title::after {
        content: '🌸';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.5rem;
        color: #e83e8c;
        animation: float 2s ease-in-out infinite alternate;
    }

    .fancy-title::before { left: -50px; }
    .fancy-title::after { right: -50px; }

    @keyframes float {
        0% { transform: translateY(-50%) rotate(0deg); }
        100% { transform: translateY(-60%) rotate(10deg); }
    }

    .certificate-content {
        position: relative;
        z-index: 2;
        padding: 2rem 1rem;
    }

    .certificate-content p {
        color: #8e4162;
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
        line-height: 1.6;
    }

    #owner-name, #bear-name {
        color: #d63384;
        font-family: 'Brush Script MT', cursive;
        font-size: 2rem !important;
        text-shadow: 2px 2px 4px rgba(255, 182, 193, 0.3);
        background: linear-gradient(45deg, #e83e8c, #da70d6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    #owner-name::after, #bear-name::after {
        content: '💕';
        position: absolute;
        right: -30px;
        top: 0;
        font-size: 1.2rem;
        -webkit-text-fill-color: #e83e8c;
        animation: heartbeat 1.5s ease-in-out infinite;
    }

    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    #adoption-date strong {
        color: #d63384;
        font-family: 'Brush Script MT', cursive;
        font-size: 1.3rem;
        text-shadow: 1px 1px 2px rgba(255, 182, 193, 0.3);
    }

    .fst-italic {
        color: #8e4162;
        font-size: 1.3rem;
        font-family: 'Brush Script MT', cursive;
        text-shadow: 1px 1px 2px rgba(255, 182, 193, 0.2);
    }

    /* Button Container */
    .d-flex.justify-content-center {
        gap: 1rem;
        margin-top: 1.5rem;
    }

    /* Decorative Elements */
    .certificate-content::before {
        content: '🦋';
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 1.5rem;
        opacity: 0.6;
        animation: flutter 4s ease-in-out infinite;
    }

    .certificate-content::after {
        content: '🌺';
        position: absolute;
        bottom: 20px;
        right: 20px;
        font-size: 1.5rem;
        opacity: 0.6;
        animation: bloom 3s ease-in-out infinite alternate;
    }

    @keyframes flutter {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-10px) rotate(5deg); }
        75% { transform: translateY(5px) rotate(-3deg); }
    }

    @keyframes bloom {
        0% { transform: scale(1) rotate(0deg); }
        100% { transform: scale(1.1) rotate(15deg); }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .fancy-title { font-size: 2rem; }
        .fancy-title::before, .fancy-title::after { display: none; }
        #owner-name, #bear-name { font-size: 1.5rem !important; }
        .certificate-content { padding: 1rem; }
    }

    /* Error styling */
    .is-invalid {
        border-color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
    }

    .invalid-feedback {
        color: #dc3545;
        font-weight: 500;
    }

    /* Input placeholder styling */
    .form-control::placeholder {
        color: #da70d6;
        opacity: 0.7;
        font-style: italic;
    }
</style>

<div class="container mt-5">
    <!-- Alert for success message -->
  
    <div class="row">
        <!-- Form Section -->
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                <form action="{{ isset($is_editing) && $is_editing ? route('pages.certificate.update', $certificate) : route('pages.certificate.generate') }}" method="POST">
    @csrf
    @if(isset($is_editing) && $is_editing)
        @method('PUT')
    @endif
                        @csrf
                        <h2 class="card-title mb-4">🐻 Your Bear Adoption Certificate 🎉</h2>
                        <p class="card-text mb-4">Fill in the details below to generate your certificate!</p>
                        
                        <div class="mb-3">
                            <label for="owner-name-input" class="form-label">Your Name:</label>
                            <input type="text" class="form-control @error('owner_name') is-invalid @enderror" 
                                id="owner-name-input" name="owner_name" 
                                placeholder="Enter your beautiful name" 
                                value="{{ old('owner_name', $owner_name ?? 'Sarah Johnson') }}">
                            @error('owner_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="bear-name-input" class="form-label">Teddy Bear's Name:</label>
                            <input type="text" class="form-control @error('bear_name') is-invalid @enderror" 
                                id="bear-name-input" name="bear_name" 
                                placeholder="Enter teddy's adorable name" 
                                value="{{ old('bear_name', $bear_name ?? 'Mr. Snuggles') }}">
                            @error('bear_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="adoption-date-input" class="form-label">Adoption Date:</label>
                            <input type="date" class="form-control @error('adoption_date') is-invalid @enderror" 
                                id="adoption-date-input" name="adoption_date" 
                                value="{{ old('adoption_date', $raw_date ?? date('Y-m-d')) }}">
                            @error('adoption_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                       
                        <button type="submit" class="btn btn-success w-100">✨ Update Certificate ✨</button>

                    </form>
                </div>
            </div>
        </div>
        
        <!-- Certificate Section -->
        <div class="col-md-7">
            <div class="card shadow mb-3">
                <div class="card-body p-4" id="certificate">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/record.jpeg') }}" alt="Bear Logo" class="certificate-logo" style="max-width: 100px;">
                    </div>
                    <h2 class="text-center fancy-title">Certificate of Bear Ownership</h2>
                    <p class="text-center mb-4">🌟 HugsyWugsy's Official Adoption Papers 🌟</p>
                    
                    <div class="certificate-content text-center">
                        <p class="mb-1">This certifies that</p>
                        <p id="owner-name" class="fs-4 fw-bold mb-1">{{ $owner_name ?? 'Sarah Johnson' }}</p>
                        <p class="mb-1">has officially adopted</p>
                        <p id="bear-name" class="fs-4 fw-bold mb-1">{{ $bear_name ?? 'Mr. Snuggles' }}</p>
                        <p id="adoption-date" class="mb-3">on <strong>{{ $adoption_date ?? 'March 14, 2025' }}</strong></p>
                        
                        <p class="mb-1">With love,</p>
                        <p class="fst-italic">The HugsyWugsy Team 💖</p>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-center gap-3">
                <button id="download-btn" class="btn btn-success">
                    <i class="fas fa-download"></i> Download
                </button>
                <button id="share-btn" class="btn btn-info">
                    <i class="fas fa-share-alt"></i> Share
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Download functionality
        document.getElementById('download-btn').addEventListener('click', function() {
            const certificateElement = document.getElementById('certificate');
            
            html2canvas(certificateElement).then(canvas => {
                const link = document.createElement('a');
                link.download = 'bear-adoption-certificate.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        });
        
        // Share functionality
        document.getElementById('share-btn').addEventListener('click', function() {
            const ownerName = document.getElementById('owner-name').textContent;
            const bearName = document.getElementById('bear-name').textContent;
            
            if (navigator.share) {
                navigator.share({
                    title: 'My Bear Adoption Certificate',
                    text: `I've adopted ${bearName} the teddy bear! Check out my official certificate from HugsyWugsy.`,
                    url: window.location.href
                })
                .then(() => console.log('Successful share'))
                .catch((error) => console.log('Error sharing:', error));
            } else {
                alert('Web Share API not supported in your browser. Try copying the URL manually.');
            }
        });
        
        // Real-time form preview
        const ownerNameInput = document.getElementById('owner-name-input');
        const bearNameInput = document.getElementById('bear-name-input');
        const adoptionDateInput = document.getElementById('adoption-date-input');
        const ownerNameDisplay = document.getElementById('owner-name');
        const bearNameDisplay = document.getElementById('bear-name'); 
        const adoptionDateDisplay = document.getElementById('adoption-date');
        
        ownerNameInput.addEventListener('input', function() {
            ownerNameDisplay.textContent = this.value || 'Sarah Johnson';
        });
        
        bearNameInput.addEventListener('input', function() {
            bearNameDisplay.textContent = this.value || 'Mr. Snuggles';
        });
        
        adoptionDateInput.addEventListener('change', function() {
            if (this.value) {
                const date = new Date(this.value);
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                adoptionDateDisplay.innerHTML = 'on <strong>' + date.toLocaleDateString('en-US', options) + '</strong>';
            } else {
                adoptionDateDisplay.innerHTML = 'on <strong>March 14, 2025</strong>';
            }
        });
    });
</script>

@endpush