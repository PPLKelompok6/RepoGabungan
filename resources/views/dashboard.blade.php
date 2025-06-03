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

    .testimonials-section {
        background-color: #f8f9fa;
        padding: 80px 0;
    }

    .section-title {
        color: #333;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .testimonial-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .user-name {
        color: #333;
        font-weight: 600;
    }

    .rating {
        font-size: 1.2rem;
    }

    .testimonial-text {
        font-style: italic;
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 1rem 0;
    }

    .text-warning {
        color: #ffd700 !important;
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
                    <a href="tel:+628111500115" class="btn btn-outline-primary btn-lg">
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

<!-- Mental Health Section -->
<div class="mental-health-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Yuk, Mulai Perjalanan Kesehatan Mental Kamu Bersama MedFast!</h2>
                <p class="lead mb-4">Kamu tidak harus menghadapi semuanya sendiri. Kami hadir untuk memberikan layanan konseling online dengan psikolog profesional dan berlisensi.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('chat.index') }}" class="btn btn-primary">Konsultasi Sekarang</a>
                    <a href="{{ route('mental-health.questions', ['type' => 'burnout']) }}" class="btn btn-outline-success">Tes Gratis</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/mental-health/online-test.svg') }}" alt="Mental Health Consultation" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Mental Health Test Categories Section -->
<div id="mental-health-test" class="mental-health-test-section py-5">
    <div class="container">
        <h2 class="text-center mb-4" style="color: #42A5F5;">Apa Yang Sedang Kamu Rasakan?</h2>
        <p class="text-center mb-5">Yuk, pilih perasaan yang sedang kamu hadapi dan temukan bantuan yang kamu butuhkan sekarang!</p>
        
        <div class="row g-4 justify-content-center">
            <!-- Card Depresi -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'depresi']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="depresi">
                        <div class="icon-wrapper">
                            <img src="{{ asset('images/mental-health/depresi.svg') }}" alt="Depresi" class="condition-icon">
                        </div>
                        <h5 class="category-title">Depresi</h5>
                    </div>
                </a>
            </div>

            <!-- Card Kecemasan -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'kecemasan']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="kecemasan">
                        <img src="{{ asset('images/mental-health/kecemasan.svg') }}" alt="Kecemasan" class="condition-icon">
                        <h5 class="category-title">Kecemasan</h5>
                    </div>
                </a>
            </div>

            <!-- Card Stres -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'stres']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="stres">
                        <img src="{{ asset('images/mental-health/stres.svg') }}" alt="Stres" class="condition-icon">
                        <h5 class="category-title">Stres</h5>
                    </div>
                </a>
            </div>

            <!-- Card Burnout -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'burnout']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="burnout">
                        <img src="{{ asset('images/mental-health/burnout.svg') }}" alt="Burnout" class="condition-icon">
                        <h5 class="category-title">Burnout</h5>
                    </div>
                </a>
            </div>

            <!-- Card Trauma -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'trauma']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="trauma">
                        <img src="{{ asset('images/mental-health/trauma.svg') }}" alt="Trauma" class="condition-icon">
                        <h5 class="category-title">Trauma</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <div class="condition-card text-center" data-condition="relationship">
                    <img src="{{ asset('images/mental-health/keluarga.svg') }}" alt="Kesulitan dalam hubungan" class="condition-icon">
                    <h5 class="category-title">Kesulitan dalam hubungan</h5>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="condition-card text-center" data-condition="mood">
                    <img src="{{ asset('images/mental-health/mood.png') }}" alt="Gangguan Mood" class="condition-icon">
                    <h5 class="category-title">Gangguan Mood</h5>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="condition-card text-center" data-condition="kecanduan">
                    <img src="{{ asset('images/mental-health/kecanduan.svg') }}" alt="Kecanduan" class="condition-icon">
                    <h5 class="category-title">Kecanduan</h5>
                </div>
            </div>
        </div>

        <!-- Deskripsi Kondisi -->
        <div class="condition-description mt-5" id="condition-details">
            <div class="description-content p-4">
                <h4 class="mb-3">Depresi: Lebih dari Sekadar Sedih Biasa</h4>
                <p>Depresi adalah gangguan kesehatan mental yang umum dan serius yang ditandai dengan suasana hati yang rendah, kehilangan minat atau kesenangan, dan berbagai gejala fisik dan mental lainnya. Meskipun kesedihan adalah emosi yang normal, depresi berbeda karena intensitas dan durasinya yang lebih besar, serta dampaknya yang signifikan pada kehidupan sehari-hari.</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="{{ route('mental-health.test', ['type' => 'depresi']) }}" class="btn btn-success rounded-pill">Tes Gratis</a>
                    <a href="{{ route('appointments.create') }}" class="btn btn-outline-success rounded-pill">Cari Psikolog</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.mental-health-test-section {
    background-color: #ffffff;
    padding: 60px 0;
}

.condition-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    transition: all 0.3s ease;
    cursor: pointer;
    height: 250px; /* Tinggi tetap untuk semua card */
    border: 1px solid #E3E3E3;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.condition-card:hover {
    transform: translateY(-5px);
    background-color: #E3F2FD;
    border-color: #42A5F5;
}

.icon-wrapper {
    width: 120px; /* Ukuran wrapper lebih besar */
    height: 120px; /* Ukuran wrapper lebih besar */
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.condition-icon {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.category-title {
    color: #42A5F5;
    font-weight: 500;
    margin-top: 15px;
}

.condition-description {
    background-color: #E3F2FD;
    border-radius: 15px;
    margin-top: 40px;
}

.description-content {
    padding: 30px;
}

.btn-success {
    background-color: #42A5F5;
    border-color: #42A5F5;
    padding: 10px 25px;
    font-weight: 500;
}

.btn-success:hover {
    background-color: #1E88E5;
    border-color: #1E88E5;
}

.btn-outline-success {
    color: #42A5F5;
    border-color: #42A5F5;
    padding: 10px 25px;
    font-weight: 500;
}

.btn-outline-success:hover {
    background-color: #42A5F5;
    color: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to test section when clicking "Tes Gratis" button
    document.querySelector('.btn-outline-success').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('mental-health-test').scrollIntoView({
            behavior: 'smooth'
        });
    });

    // Handle condition card clicks
    const conditionCards = document.querySelectorAll('.condition-card');
    const conditionDetails = document.getElementById('condition-details');

    // Definisi deskripsi untuk setiap kondisi
    const conditionDescriptions = {
        'depresi': {
            title: 'Depresi: Lebih dari Sekadar Sedih Biasa',
            description: 'Depresi adalah gangguan kesehatan mental yang umum dan serius yang ditandai dengan suasana hati yang rendah, kehilangan minat atau kesenangan, dan berbagai gejala fisik dan mental lainnya. Meskipun kesedihan adalah emosi yang normal, depresi berbeda karena intensitas dan durasinya yang lebih besar, serta dampaknya yang signifikan pada kehidupan sehari-hari.'
        },
        'kecemasan': {
            title: 'Kecemasan: Lebih dari Sekadar Gugup Biasa',
            description: 'Kecemasan adalah perasaan khawatir atau takut yang intens dan menetap. Meskipun rasa cemas sesekali adalah normal, terutama dalam situasi yang penuh tekanan, kecemasan yang berlebihan dan berkepanjangan dapat mengganggu kehidupan sehari-hari.'
        },
        'stres': {
            title: 'Stres: Musuh Terselubung Kesehatan Mental Kita',
            description: 'Stres adalah reaksi alami tubuh terhadap situasi yang penuh tekanan. Ini adalah alarm internal yang memperingatkan kita bahwa ada sesuatu yang perlu dihadapi. Dalam kadar yang wajar, stres bisa memotivasi kita untuk bertindak dan mencapai tujuan. Namun, jika dibiarkan berlarut-larut dan tidak dikelola dengan baik, stres bisa menjadi musuh terselubung kesehatan mental kita.'
        },
        'trauma': {
            title: 'Trauma: Luka Tak Kasat Mata yang Mempengaruhi Kesehatan Mental',
            description: 'Trauma adalah reaksi emosional yang intens dan berkepanjangan terhadap peristiwa yang sangat menegangkan atau menakutkan. Peristiwa tersebut bisa berupa kekerasan fisik atau seksual, kecelakaan, bencana alam, perang, atau penganiayaan.'
        },
        'burnout': {
            title: 'Burnout: Musuh Terselubung Kesehatan Mental Kita',
            description: 'Burnout adalah keadaan kelelahan emosional, mental, dan fisik yang disebabkan oleh stres berkepanjangan. Ini terjadi ketika seseorang merasa terlalu tertekan dan kewalahan, dan tidak dapat lagi mengatasi tuntutan yang dihadapi. Burnout dapat berdampak negatif pada semua aspek kehidupan Anda, termasuk pekerjaan, hubungan, dan kesehatan fisik.'
        },
        'relationship': {
            title: 'Terapi Keluarga dan Hubungan: Meraih Harmoni Bersama',
            description: 'Terapi keluarga dan hubungan adalah bentuk terapi bicara yang bertujuan membantu individu, pasangan, atau keluarga mengatasi berbagai masalah hubungan. Terapis berlatih membantu para peserta untuk memahami pola komunikasi dan interaksi mereka, mengidentifikasi sumber konflik, dan mengembangkan keterampilan komunikasi dan manajemen konflik yang lebih efektif.'
        },
        'mood': {
            title: 'Permainan Suasana Hati: Mengenal Gangguan Mood',
            description: 'Gangguan mood adalah kelompok gangguan kesehatan mental yang ditandai dengan perubahan suasana hati yang ekstrem dan berlangsung lama. Gangguan ini berbeda dengan fluktuasi emosi normal yang dialami semua orang, karena intensitas, durasi, dan dampaknya yang lebih signifikan terhadap kehidupan sehari-hari.'
        },
        'kecanduan': {
            title: 'Kecanduan: Memahami dan Mengatasi Ketergantungan',
            description: 'Kecanduan atau adiksi adalah kondisi saat seseorang tidak dapat berhenti mengkonsumsi suatu zat atau melakukan sebuah kegiatan. Orang dengan kecanduan akan kehilangan kontrol terhadap perilakunya meskipun hal itu bisa merusak kehidupan rumah tangga, pekerjaan, atau hubungan pertemanannya. Segera dapatkan bantuan profesional untuk mengatasi kecanduan serta mendapatkan cara yang tepat untuk mengatasinya.'
        }
    };

    conditionCards.forEach(card => {
        card.addEventListener('click', function() {
            // Hapus kelas active dari semua card
            conditionCards.forEach(c => c.classList.remove('active'));
            
            // Tambahkan kelas active ke card yang diklik
            this.classList.add('active');
            
            // Dapatkan kondisi dari atribut data
            const condition = this.getAttribute('data-condition');
            
            // Perbarui konten deskripsi
            const descriptionContent = conditionDetails.querySelector('.description-content');
            descriptionContent.innerHTML = `
                <h4 class="mb-3">${conditionDescriptions[condition].title}</h4>
                <p>${conditionDescriptions[condition].description}</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="btn btn-success rounded-pill">Tes Gratis</a>
                    <a href="#" class="btn btn-outline-success rounded-pill">Cari Psikolog</a>
                </div>
            `;
            
            // Tampilkan deskripsi
            conditionDetails.classList.remove('d-none');
            
            // Scroll ke deskripsi
            conditionDetails.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        });
    });
});
</script>

<style>
.mental-health-section {
    background-color: #f8f9fa;
    padding: 80px 0;
}

.mental-health-section h2 {
    color: #333;
    font-size: 2.5rem;
    font-weight: 600;
}

.mental-health-section .lead {
    color: #666;
    font-size: 1.2rem;
}

.btn-success {
    background-color: #0047AB;
    border-color: #0047AB;
    padding: 10px 25px;
    font-weight: 500;
}

.btn-success:hover {
    background-color: #0047AB;
    border-color: #0047AB;
}

.btn-outline-success {
    color: #0047AB;
    border-color: #0047AB;
    padding: 10px 25px;
    font-weight: 500;
}

.btn-outline-success:hover {
    background-color: #0047AB;
    color: white;
}

.img-fluid {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>

<!-- Online Consultation Section -->
<div class="consultation-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Yuk, Mulai Perjalanan Kesehatan Mental Kamu Bersama MedFast!</h2>
                <p class="lead mb-4">Kamu tidak perlu menghadapi semuanya sendiri. MedFast hadir siap mendampingi kamu melalui layanan konsultasi online bersama dokter profesional dan berlisensi.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('chat.index') }}" class="btn btn-primary">Konsultasi Sekarang</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="consultation-image">
                    <img src="{{ asset('images/mental-health/consultation.svg') }}" alt="Psychological Test" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.consultation-section h2 {
    font-size: 2.5rem;
    font-weight: 600;
    color: #333;
    line-height: 1.2;
}

.consultation-section .lead {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.6;
}

.consultation-section .btn {
    padding: 12px 30px;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.consultation-section .btn-primary {
    background-color: #0047AB;
    border-color: #0047AB;
}

.consultation-section .btn-primary:hover {
    background-color: #0047AB;
    border-color: #0047AB;
}

.consultation-section .btn-outline-primary {
    color: #0047AB;
    border-color: #0047AB;
}

.consultation-section .btn-outline-primary:hover {
    background-color: #0047AB;
    color: #fff;
}

.consultation-image {
    text-align: center;
}

.consultation-image img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

@media (max-width: 991.98px) {
    .consultation-section {
        padding: 60px 0;
    }
    
    .consultation-section h2 {
        font-size: 2rem;
    }
    
    .consultation-image {
        margin-top: 40px;
    }
}
</style>

<!-- Articles Section -->
@if(isset($articles) && $articles->count() > 0)
    <div class="row">
        <div class="col-12">
            <h2>Artikel Kesehatan Terbaru</h2>
            <p class="text-muted">Informasi Kesehatan untuk Anda</p>
        </div>
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
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

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

                            <form action="{{ route('feedback.store') }}" method="POST">
                                @csrf
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
