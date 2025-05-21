@extends('layouts.app')

@section('content')
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
                    <a href="tel:123-4567-890" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-phone-alt me-2"></i>123 4567 890
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/doctor.png') }}" alt="Doctor" class="img-fluid hero-image" onerror="this.src='{{ asset('images/default-doctor.png') }}'">
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

<!-- Mental Health Section -->
<div class="mental-health-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Yuk, Mulai Perjalanan Kesehatan Mental Kamu Bersama MedFast!</h2>
                <p class="lead mb-4">Kamu tidak harus menghadapi semuanya sendiri. Kami hadir untuk memberikan layanan konseling online dengan psikolog profesional dan berlisensi.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('mental-health.test', ['type' => 'burnout']) }}" class="btn btn-success">Konsultasi Sekarang</a>
                    <a href="{{ route('mental-health.questions', ['type' => 'burnout']) }}" class="btn btn-outline-success">Tes Gratis</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/mental-health/consultation.png') }}" alt="Mental Health Consultation" class="img-fluid">
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
                            <img src="{{ asset('images/mental-health/depresi.png') }}" alt="Depresi" class="condition-icon">
                        </div>
                        <h5 class="mt-2 category-title">Depresi</h5>
                    </div>
                </a>
            </div>

            <!-- Card Kecemasan -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'kecemasan']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="kecemasan">
                        <img src="{{ asset('images/mental-health/kecemasan.png') }}" alt="Kecemasan" class="condition-icon mb-3">
                        <h5 class="category-title">Kecemasan</h5>
                    </div>
                </a>
            </div>

            <!-- Card Stres -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'stres']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="stres">
                        <img src="{{ asset('images/mental-health/stres.png') }}" alt="Stres" class="condition-icon mb-3">
                        <h5 class="category-title">Stres</h5>
                    </div>
                </a>
            </div>

            <!-- Card Burnout -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'burnout']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="burnout">
                        <img src="{{ asset('images/mental-health/burnout.png') }}" alt="Burnout" class="condition-icon mb-3">
                        <h5>Burnout</h5>
                    </div>
                </a>
            </div>

            <!-- Card Trauma -->
            <div class="col-md-3 col-6">
                <a href="{{ route('mental-health.test', ['type' => 'trauma']) }}" class="text-decoration-none">
                    <div class="condition-card text-center" data-condition="trauma">
                        <img src="{{ asset('images/mental-health/trauma.png') }}" alt="Trauma" class="condition-icon mb-3">
                        <h5>Trauma</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <div class="condition-card text-center" data-condition="relationship">
                    <img src="{{ asset('images/mental-health/relationship.png') }}" alt="Kesulitan dalam hubungan" class="condition-icon mb-3">
                    <h5>Kesulitan dalam hubungan</h5>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="condition-card text-center" data-condition="mood">
                    <img src="{{ asset('images/mental-health/mood.png') }}" alt="Gangguan Mood" class="condition-icon mb-3">
                    <h5>Gangguan Mood</h5>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="condition-card text-center" data-condition="kecanduan">
                    <img src="{{ asset('images/mental-health/kecanduan.png') }}" alt="Kecanduan" class="condition-icon mb-3">
                    <h5>Kecanduan</h5>
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
                    <img src="{{ asset('images/psychological-test.png') }}" alt="Psychological Test" class="img-fluid">
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
