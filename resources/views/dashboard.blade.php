@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 mb-4">Your Trust is Our <span class="text-primary">Greatest Priority</span></h1>
                <p class="lead mb-4">Experience the convenience of campus-based healthcare solutions. Get the quality care you deserve, right where you are.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Book Appointment</a>
                    <a href="tel:+1234567890" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-phone-alt me-2"></i>123 4567 890
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/doctor.png') }}" alt="Doctor" class="img-fluid hero-image">
            </div>
        </div>
    </div>
</div>

<div class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Why You Should Trust Us?</h2>
            <p class="text-muted">Get to Know About Us</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h4>All Specialists</h4>
                    <p class="text-muted">Access our network of qualified medical professionals ready to provide expert care for your health needs.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Private & Secure</h4>
                    <p class="text-muted">Your health information is protected with state-of-the-art security measures.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p class="text-muted">Our dedicated support team is always available to assist you with any concerns.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection