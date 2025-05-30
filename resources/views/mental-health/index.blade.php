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
                    'image' => 'burnout.svg',
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
                    'image' => 'trauma.svg',
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
            <div class="kartu-tes">
                <h3 class="judul-tes">{{ $test['title'] }}</h3>
                <p class="deskripsi-tes">{{ $test['description'] }}</p>
                <div class="gambar-wrapper">
                    <img src="{{ asset('images/mental-health/' . $test['image']) }}" 
                         alt="{{ $test['title'] }} Illustration" 
                         class="gambar-tes">
                </div>
                <a href="{{ route('mental-health.test', ['type' => $test['type']]) }}" class="tombol-mulai">
                    Mulai tes <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
.kartu-tes {
    background: white;
    border-radius: 25px;
    border: 2px solid #03A9F4;
    padding: 25px;
    height: 100%;
    position: relative;
    display: flex;
    flex-direction: column;
    min-height: 300px;
}

.judul-tes {
    color: #03A9F4;
    font-size: 24px;
    margin-bottom: 15px;
    font-weight: bold;
    position: relative;
    z-index: 2;
}

.deskripsi-tes {
    color: #333;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
    width: 60%;
}

.gambar-wrapper {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    width: 160px;
    height: 160px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
}

.gambar-tes {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.tombol-mulai {
    background-color: #00B0FF;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: fit-content;
    position: relative;
    z-index: 2;
    margin-top: auto;
}

.tombol-mulai:hover {
    background-color: #0091EA;
    color: white;
    text-decoration: none;
}
</style>
@endpush
