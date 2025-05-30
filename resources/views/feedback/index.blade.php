@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Feedback & Rating Section -->
<div class="feedback-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Feedback & Rating</h2>
            <p class="text-muted">Bantu Kami Meningkatkan Layanan</p>
        </div>

        <!-- Form Feedback Card -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        @auth
                            <!-- Flash Messages -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="text-center">
                                <form action="{{ route('feedback.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Rating</label>
                                        <div class="rating-input">
                                            <div class="d-flex gap-3 justify-content-center">
                                                <input type="radio" id="star5" name="rating" value="5" class="d-none" required>
                                                <label for="star5" class="star-label fs-2"><i class="far fa-star"></i></label>
                                                
                                                <input type="radio" id="star4" name="rating" value="4" class="d-none">
                                                <label for="star4" class="star-label fs-2"><i class="far fa-star"></i></label>
                                                
                                                <input type="radio" id="star3" name="rating" value="3" class="d-none">
                                                <label for="star3" class="star-label fs-2"><i class="far fa-star"></i></label>
                                                
                                                <input type="radio" id="star2" name="rating" value="2" class="d-none">
                                                <label for="star2" class="star-label fs-2"><i class="far fa-star"></i></label>
                                                
                                                <input type="radio" id="star1" name="rating" value="1" class="d-none">
                                                <label for="star1" class="star-label fs-2"><i class="far fa-star"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="comment" class="form-label">Komentar</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Berikan kritik dan saran Anda" style="border-radius: 10px; border-color: #dee2e6;"></textarea>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary px-4 py-2">Kirim Feedback</button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="mb-3">Silakan login untuk memberikan feedback dan rating</p>
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        @if(isset($feedbacks) && count($feedbacks) > 0)
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <h4 class="mb-4">Testimonial Pengguna</h4>
                    @foreach($feedbacks as $feedback)
                        <div class="testimonial-item mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="User Avatar" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $feedback->user->name }}</h6>
                                    <div class="rating mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $feedback->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="mb-0" style="font-style: italic;">"{{ $feedback->comment }}"</p>
                                </div>
                                <small class="text-muted">{{ $feedback->created_at->diffForHumans() }}</small>
                            </div>
                            <hr class="my-3">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* Rating styles */
.rating-input .star-label {
    cursor: pointer;
    color: #ffd700;
    transition: all 0.2s ease;
}

.rating-input .star-label:hover,
.rating-input .star-label:hover ~ .star-label {
    transform: scale(1.1);
}

.rating-input input[type="radio"]:checked + .star-label i:before,
.rating-input .star-label:hover i:before,
.rating-input .star-label:hover ~ .star-label i:before {
    content: "\f005";
    font-weight: 900;
}

.testimonial-item:last-child hr {
    display: none;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.btn-primary {
    background-color: #0047AB;
    border-color: #0047AB;
}

.btn-primary:hover {
    background-color: #003380;
    border-color: #003380;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Star rating functionality
    const starLabels = document.querySelectorAll('.star-label');
    
    starLabels.forEach(label => {
        label.addEventListener('mouseover', function() {
            const stars = this.parentElement.children;
            const currentStarValue = this.previousElementSibling.value;
            
            for(let i = 0; i < stars.length; i++) {
                if(i < currentStarValue) {
                    stars[i].querySelector('i').classList.remove('far');
                    stars[i].querySelector('i').classList.add('fas');
                } else {
                    stars[i].querySelector('i').classList.remove('fas');
                    stars[i].querySelector('i').classList.add('far');
                }
            }
        });
        
        label.addEventListener('click', function() {
            const stars = this.parentElement.children;
            const currentStarValue = this.previousElementSibling.value;
            
            for(let i = 0; i < stars.length; i++) {
                if(i < currentStarValue) {
                    stars[i].querySelector('i').classList.remove('far');
                    stars[i].querySelector('i').classList.add('fas');
                } else {
                    stars[i].querySelector('i').classList.remove('fas');
                    stars[i].querySelector('i').classList.add('far');
                }
            }
            
            this.previousElementSibling.checked = true;
        });
    });
});
</script>
@endsection