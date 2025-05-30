@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/mental-health/' . strtolower($category) . 'result.png') }}" 
                             alt="Result Illustration" 
                             class="img-fluid mb-3" 
                             style="max-width: 250px;">
                        
                        <h4 class="mb-3">Level stres {{ $gender }}: {{ $age }} tahun</h4>
                        <h2 class="mb-4">{{ $category }}</h2>

                        <!-- Progress Bar -->
                        <div class="position-relative mb-4">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" style="width: 33%"></div>
                                <div class="progress-bar bg-warning" style="width: 33%"></div>
                                <div class="progress-bar bg-danger" style="width: 34%"></div>
                            </div>
                            <div class="position-absolute" 
                                 style="left: {{ ($score/132) * 100 }}%; transform: translateX(-50%); top: -25px;">
                                <span class="badge bg-dark">{{ $score }}</span>
                            </div>
                        </div>

                        <!-- Recommendations -->
                        <div class="text-start mt-4">
                            @foreach($recommendations as $recommendation)
                                <p class="mb-2">• {{ $recommendation }}</p>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-outline-primary" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#perhitungan">
                                Lihat Perhitungan
                            </button>
                            <a href="{{ route('mental-health.questions', ['type' => $type]) }}" 
                               class="btn btn-primary">
                                Cek Ulang
                            </a>
                        </div>

                        <!-- Perhitungan Collapse -->
                        <div class="collapse mt-4" id="perhitungan">
                            <div class="card card-body">
                                <h5>Cara Perhitungan:</h5>
                                <p>Total Skor: {{ $score }} dari 132 poin maksimum</p>
                                <p>Kategori Burnout:</p>
                                <ul>
                                    <li>Rendah: 0-44 poin</li>
                                    <li>Sedang: 45-88 poin</li>
                                    <li>Tinggi: 89-132 poin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Psikolog Section -->
            <div class="card shadow-sm border-0 rounded-4 mt-5">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Mau Mulai Konsultasi?</h2>
                    <h3 class="text-center mb-5">Yuk Kenali Psikolog Kami!</h3>

                    <div class="row g-4">
                        <!-- Psikolog 1 -->
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="mx-auto mb-3" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('images/psikolog/Rania.jpg') }}" 
                                         class="rounded-circle img-fluid w-100 h-100 object-fit-cover"
                                         alt="Rania Putri">
                                </div>
                                <h5 class="mb-1">Rania Putri, M.Psi.</h5>
                                <p class="text-muted mb-3">Psikolog Klinis</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm px-3">Lihat profil</a>
                                    <a href="#" class="btn btn-warning btn-sm px-3">Konsultasi</a>
                                </div>
                            </div>
                        </div>

                        <!-- Psikolog 2 -->
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="mx-auto mb-3" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('images/psikolog/Intan.jpg') }}" 
                                         class="rounded-circle img-fluid w-100 h-100 object-fit-cover"
                                         alt="Intan Maharani">
                                </div>
                                <h5 class="mb-1">Intan Maharani, M.Si.</h5>
                                <p class="text-muted mb-3">Psikolog Klinis</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm px-3">Lihat profil</a>
                                    <a href="#" class="btn btn-warning btn-sm px-3">Konsultasi</a>
                                </div>
                            </div>
                        </div>

                        <!-- Psikolog 3 -->
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="mx-auto mb-3" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('images/psikolog/Hanum.png') }}" 
                                         class="rounded-circle img-fluid w-100 h-100 object-fit-cover"
                                         alt="Hanum Salsabila">
                                </div>
                                <h5 class="mb-1">Hanum Salsabila, M.Psi.</h5>
                                <p class="text-muted mb-3">Psikolog Klinis</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm px-3">Lihat profil</a>
                                    <a href="#" class="btn btn-warning btn-sm px-3">Konsultasi</a>
                                </div>
                            </div>
                        </div>

                        <!-- Psikolog 4 -->
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="mx-auto mb-3" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('images/psikolog/Fadlan.jpg') }}" 
                                         class="rounded-circle img-fluid w-100 h-100 object-fit-cover"
                                         alt="Fadlan Pratama">
                                </div>
                                <h5 class="mb-1">Fadlan Pratama, M.Psi.</h5>
                                <p class="text-muted mb-3">Psikolog Klinis</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm px-3">Lihat profil</a>
                                    <a href="#" class="btn btn-warning btn-sm px-3">Konsultasi</a>
                                </div>
                            </div>
                        </div>

                        <!-- Psikolog 5 -->
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="mx-auto mb-3" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('images/psikolog/Reza.jpg') }}" 
                                         class="rounded-circle img-fluid w-100 h-100 object-fit-cover"
                                         alt="Dr.Reza Mahendra">
                                </div>
                                <h5 class="mb-1">Dr.Reza Mahendra, M.Psi.</h5>
                                <p class="text-muted mb-3">Psikolog Klinis</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm px-3">Lihat profil</a>
                                    <a href="#" class="btn btn-warning btn-sm px-3">Konsultasi</a>
                                </div>
                            </div>
                        </div>

                        <!-- Psikolog 6 -->
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="mx-auto mb-3" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('images/psikolog/Arief.jpg') }}" 
                                         class="rounded-circle img-fluid w-100 h-100 object-fit-cover"
                                         alt="Arief Nugraha">
                                </div>
                                <h5 class="mb-1">Arief Nugraha, M.Psi.</h5>
                                <p class="text-muted mb-3">Psikolog Klinis</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm px-3">Lihat profil</a>
                                    <a href="#" class="btn btn-warning btn-sm px-3">Konsultasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .progress {
        background-color: #f8f9fa;
        border-radius: 1rem;
        overflow: hidden;
    }
    .progress-bar {
        transition: width 0.6s ease;
    }
    .btn-primary {
        background-color: #03A9F4;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0288D1;
    }
    .btn-outline-primary {
        color: #03A9F4;
        border-color: #03A9F4;
    }
    .btn-outline-primary:hover {
        background-color: #03A9F4;
        color: white;
    }
    .btn-warning {
        background-color: #FFC107;
        border: none;
        color: #000;
    }
    .btn-warning:hover {
        background-color: #FFA000;
        color: #000;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush
@endsection