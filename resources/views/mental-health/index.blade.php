@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="text-primary" style="color: #03A9F4 !important;">Tes Psikologi Gratis</h1>
        <p class="lead px-4">
            Ingin tahu kondisi kesehatan mentalmu? Kamu bisa mencoba tes psikologi di bawah ini dengan gratis! 
            Dapatkan gambaran singkat tentang tingkat stres, burnout, depresi, trauma, kecemasan, dan lainnya. 
            Kenali dirimu lebih baik dan temukan cara untuk meningkatkan kesejahteraan mentalmu.
        </p>
    </div>

    <!-- Test Cards -->
    <div class="row justify-content-center g-4">
        @php
            $tests = [
                [
                    'title' => 'Burnout',
                    'description' => 'Ingin tahu apakah kamu mengalami burnout? Tes ini dapat membantu mengukur tingkat burnout yang mungkin kamu alami akibat stres di lingkup pekerjaan.',
                    'image' => 'burnout.png',
                    'type' => 'burnout',
                ],
                [
                    'title' => 'Depresi',
                    'description' => 'Menderita gejala depresi? Tes ini dapat membantu melihat tingkat depresi yang mungkin kamu alami. Semakin cepat terdeteksi, semakin cepat pula kamu bisa menemukan cara mengatasi depresi.',
                    'image' => 'depresi.png',
                    'type' => 'depresi',
                ],
                [
                    'title' => 'Kecemasan',
                    'description' => 'Merasa khawatir dan gelisah terus-menerus? Tes ini dapat membantu melihat tingkat kecemasan yang mungkin kamu alami. Hasil tes ini dapat menjadi langkah awalmu untuk mencari bantuan profesional jika diperlukan.',
                    'image' => 'kecemasan.png',
                    'type' => 'kecemasan',
                ],
                [
                    'title' => 'Trauma',
                    'description' => 'Ingin pulih dari trauma masa lalu? Tes trauma ini dapat menjadi langkah pertama yang penting. Dengan bantuan profesional, kamu dapat menemukan kesejahteraan mental dan emosional.',
                    'image' => 'trauma.png',
                    'type' => 'trauma',
                ],
                [
                    'title' => 'Keluarga & Hubungan',
                    'description' => 'Merasa kurang harmonis dalam hubunganmu? Tes hubungan untuk pasangan atau keluarga ini dapat membantumu menemukan cara mengatasi masalah dan membangun hubungan yang lebih harmonis.',
                    'image' => 'relationship.png',
                    'type' => 'keluarga',
                ],
                [
                    'title' => 'Kecanduan',
                    'description' => 'Merasa bergantung pada sesuatu seperti gawai, media sosial, atau zat tertentu? Tes ini dapat membantumu mengenali tanda-tanda kecanduan dan menjadi langkah awal menuju pemulihan.',
                    'image' => 'kecanduan.png',
                    'type' => 'kecanduan',
                ],
            ];
        @endphp

        @foreach($tests as $test)
        <div class="col-md-4 mb-4">
            <div class="mental-health-card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title">{{ $test['title'] }}</h3>
                    <p class="card-text">{{ $test['description'] }}</p>
                    <img src="{{ asset('images/mental-health/' . $test['image']) }}" 
                         alt="{{ $test['title'] }} Illustration" class="category-image">
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('mental-health.test', ['type' => $test['type']]) }}" class="test-button">
                            Mulai tes <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
.mental-health-card {
    background: white;
    border-radius: 20px;
    border: 2px solid #03A9F4;
    padding: 20px;
    height: 100%;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.mental-health-card:hover {
    box-shadow: 0 4px 15px rgba(3, 169, 244, 0.1);
}

.card-title {
    color: #03A9F4;
    font-size: 24px;
    margin-bottom: 15px;
}

.card-text {
    color: #333;
    margin-bottom: 80px;
}

.card-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
}

.category-image {
    width: 150px;
    height: 150px;
    object-fit: contain;
    position: absolute;
    right: 20px;
    bottom: 60px;
    z-index: 0;
}

.test-button {
    background-color: #03A9F4;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 10px 25px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
    justify-content: center;
}

.test-button:hover {
    background-color: #0288D1;
    transform: translateY(-2px);
}
</style>
@endpush
