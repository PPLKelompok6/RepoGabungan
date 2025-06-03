@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .hero-section {
        background-color: #ffffff;
        padding: 80px 0;
    }
    
    .text-primary {
        color: #0047AB !important;
    }
    
    .btn-primary {
        background-color: #0047AB;
        border-color: #0047AB;
    }
    
    .feature-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .feature-icon {
        font-size: 2.5rem;
        color: #0047AB;
    }
    
    .doctor-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }
    
    .doctor-card:hover {
        transform: translateY(-5px);
    }
    
    .doctor-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 15px;
    }
    
    .rating {
        color: #FFD700;
        margin: 10px 0;
    }
</style>

<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 mb-4">Your Trust is Our <span class="text-primary">Greatest Priority</span></h1>
                <p class="lead mb-4">Experience the convenience of campus-based healthcare solutions. Get the quality care you deserve, right where you are.</p>
                <div class="d-flex gap-3">
                    @auth
                        @if(Auth::user()->role === 'user')
                            <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg">Book Appointment</a>
                        @else
                            <a href="{{ route('appointments.index') }}" class="btn btn-primary btn-lg">View Appointments</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Book Appointment</a>
                    @endauth
                    <a href="tel:08111 1500 115" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-phone-alt me-2"></i>08111 1500 115
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/doctor.png') }}" alt="Doctor" class="img-fluid" style="border-radius: 20px;" onerror="this.src='{{ asset('images/default-doctor.png') }}'">
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Our Services</h2>
            <p class="text-muted">Comprehensive Healthcare Solutions</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h5>Cardiology</h5>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h5>Neurology</h5>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-tooth"></i>
                    </div>
                    <h5>Dental Care</h5>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h5>Eye Care</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Doctors Section -->
<div class="doctors-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Tim Dokter Kami</h2>
            <p class="text-muted">Bertemu dengan Tim Ahli Kami</p>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="doctor-card">
                    <img src="{{ asset('images/doctor1.png') }}" alt="Doctor" class="doctor-image" onerror="this.src='{{ asset('images/default-doctor.png') }}'">
                    <h5>Dr. Andi Wijaya</h5>
                    <p class="text-muted">Spesialis Jantung</p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Buat Janji</a>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="doctor-card">
                    <img src="{{ asset('images/doctor2.png') }}" alt="Doctor" class="doctor-image" onerror="this.src='{{ asset('images/default-doctor.png') }}'">
                    <h5>Dr. Sarah Putri</h5>
                    <p class="text-muted">Spesialis Saraf</p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Buat Janji</a>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="doctor-card">
                    <img src="{{ asset('images/doctor3.png') }}" alt="Doctor" class="doctor-image" onerror="this.src='{{ asset('images/default-doctor.png') }}'">
                    <h5>Dr. Anselma Putri</h5>
                    <p class="text-muted">Spesialis Gigi</p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Buat Janji</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Articles Section -->
<div class="articles-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Artikel Kesehatan Terbaru</h2>
            <p class="text-muted">Informasi Kesehatan untuk Anda</p>
        </div>
        
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($article->image)
                            <img src="{{ asset($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $article->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.article-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.article-card:hover {
    transform: translateY(-5px);
}

.article-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.article-date {
    color: #666;
    font-size: 0.9rem;
}

.article-content {
    background: white;
}

.btn-outline-primary {
    color: #0047AB;
    border-color: #0047AB;
}

.btn-outline-primary:hover {
    background-color: #0047AB;
    color: white;
}
</style>

<!-- About MedFast Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="about-section">
                <h2 class="text-center mb-5">Tentang MedFast</h2>
                
                <!-- Tujuan Section -->
                <div class="about-content mb-5">
                    <h3 class="mb-3">Tujuan MedFast</h3>
                    <p>MedFast hadir dengan tujuan untuk memberikan solusi layanan kesehatan yang cepat, efisien, dan terpercaya bagi masyarakat Indonesia. Kami berkomitmen untuk memudahkan akses layanan kesehatan melalui platform digital yang inovatif.</p>
                </div>

                <!-- Sejarah Section -->
                <div class="about-content mb-5">
                    <h3 class="mb-3">Sejarah MedFast</h3>
                    <p>MedFast didirikan pada tahun 2024 sebagai solusi inovatif dalam bidang kesehatan digital. Berawal dari keprihatinan akan sulitnya akses layanan kesehatan yang cepat dan efisien, tim kami memutuskan untuk mengembangkan platform yang menghubungkan pasien dengan layanan kesehatan secara digital.</p>
                </div>

                <!-- Visi & Misi Section -->
                <div class="about-content mb-5">
                    <h3 class="mb-3">Visi</h3>
                    <p>Menjadi platform layanan kesehatan digital terdepan yang menghadirkan kemudahan akses layanan kesehatan berkualitas bagi seluruh masyarakat Indonesia.</p>
                </div>

                <div class="about-content mb-5">
                    <h3 class="mb-3">Misi</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">✓ Menyediakan layanan konsultasi kesehatan online yang cepat dan terpercaya</li>
                        <li class="mb-2">✓ Membangun jaringan dokter dan tenaga kesehatan profesional yang berkualitas</li>
                        <li class="mb-2">✓ Mengembangkan teknologi kesehatan yang inovatif dan mudah diakses</li>
                        <li class="mb-2">✓ Memberikan edukasi kesehatan yang akurat dan bermanfaat bagi masyarakat</li>
                    </ul>
                </div>

                <!-- Tim Pengembang Section -->
                <div class="text-center mb-5">
                    <h2>Tim Pengembang</h2>
                    <p class="text-muted">Bertemu dengan Tim Kami</p>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="developer-card">
                            <img src="{{ asset('images/team/allicia.jpg') }}" alt="Allicia" class="developer-image" onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <h5 class="mt-3">Allicia Felicitas Gonza Batas</h5>
                            <p class="text-muted">Project Manager</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="developer-card">
                            <img src="{{ asset('images/team/athar.jpg') }}" alt="Athar" class="developer-image" onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <h5 class="mt-3">M Athar Ghiffari</h5>
                            <p class="text-muted">Front End Developer</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="developer-card">
                            <img src="{{ asset('images/team/mahendra.jpg') }}" alt="Mahendra" class="developer-image" onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <h5 class="mt-3">Mahendra Arya</h5>
                            <p class="text-muted">Back End Developer</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="developer-card">
                            <img src="{{ asset('images/team/nicholas.jpg') }}" alt="Nicholas" class="developer-image" onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <h5 class="mt-3">Nicholas Alexander</h5>
                            <p class="text-muted">UI/UX Designer</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="developer-card">
                            <img src="{{ asset('images/team/azka.jpg') }}" alt="Azka" class="developer-image" onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <h5 class="mt-3">Muhammad Azka Farhan</h5>
                            <p class="text-muted">Front End Developer</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="developer-card">
                            <img src="{{ asset('images/team/faqih.jpg') }}" alt="Faqih" class="developer-image" onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            <h5 class="mt-3">Muhammad Faqih Naufaldy</h5>
                            <p class="text-muted">Back End Developer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .about-section {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .about-content {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .about-content:last-child {
        border-bottom: none;
    }

    .developer-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .developer-card:hover {
        transform: translateY(-5px);
    }

    .developer-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto;
    }
</style>

@endsection