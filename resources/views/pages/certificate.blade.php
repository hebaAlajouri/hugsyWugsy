@extends('layouts.app2')

@section('title', 'Bear Adoption Certificate')



@section('content')
<div class="container mt-5">
    <!-- Alert for success message -->
  
    <div class="row">
        <!-- Form Section -->
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('pages.certificate.generate') }}" method="POST">
                        @csrf
                        <h2 class="card-title mb-4">🐻 Your Bear Adoption Certificate 🎉</h2>
                        <p class="card-text mb-4">Fill in the details below to generate your certificate!</p>
                        
                        <div class="mb-3">
                            <label for="owner-name-input" class="form-label">Your Name:</label>
                            <input type="text" class="form-control @error('owner_name') is-invalid @enderror" 
                                id="owner-name-input" name="owner_name" 
                                placeholder="Enter your name" 
                                value="{{ old('owner_name', $owner_name ?? 'Sarah Johnson') }}">
                            @error('owner_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="bear-name-input" class="form-label">Teddy Bear's Name:</label>
                            <input type="text" class="form-control @error('bear_name') is-invalid @enderror" 
                                id="bear-name-input" name="bear_name" 
                                placeholder="Enter teddy's name" 
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
                        
                       
                        <button type="submit" class="btn btn-success w-100">Update Certificate</button>

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

@push('styles')
<link rel="stylesheet" href="{{ asset('css/certificate.css') }}">
@endpush

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
