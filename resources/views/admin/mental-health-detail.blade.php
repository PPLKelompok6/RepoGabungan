@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">Detail Hasil Tes</h2>
                        <a href="{{ route('admin.mental-health.results') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    <!-- Informasi Pasien -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Informasi Pasien</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Nama:</strong> {{ $test->user->name }}</p>
                                    <p class="mb-2"><strong>Email:</strong> {{ $test->user->email }}</p>
                                    <p class="mb-2"><strong>Usia:</strong> {{ $test->usia }} tahun</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Gender:</strong> {{ $test->gender }}</p>
                                    <p class="mb-2"><strong>Domisili:</strong> {{ $test->domisili }}</p>
                                    <p class="mb-2"><strong>Pekerjaan:</strong> {{ $test->pekerjaan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Tes -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Hasil Tes {{ ucfirst($test->test_type) }}</h5>
                            <div class="row align-items-center mb-4">
                                <div class="col-md-6">
                                    <h3 class="mb-2">Skor: {{ $test->score }}</h3>
                                    @php
                                        $badgeClass = match($level) {
                                            'Rendah' => 'bg-success',
                                            'Sedang' => 'bg-warning',
                                            'Tinggi' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} px-3 py-2">Level: {{ $level }}</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-success" style="width: 33%"></div>
                                        <div class="progress-bar bg-warning" style="width: 33%"></div>
                                        <div class="progress-bar bg-danger" style="width: 34%"></div>
                                    </div>
                                    <div class="position-relative">
                                        <div class="position-absolute" 
                                             style="left: {{ ($test->score/132) * 100 }}%; transform: translateX(-50%); top: 5px;">
                                            <i class="fas fa-caret-up text-dark fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-0">
                                Tes dilakukan pada: {{ $test->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Rekomendasi -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Rekomendasi</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($recommendations as $recommendation)
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        {{ $recommendation }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.progress {
    border-radius: 10px;
    overflow: hidden;
}

.badge {
    font-weight: 500;
    font-size: 0.9rem;
    border-radius: 20px;
}

.list-unstyled li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.list-unstyled li:last-child {
    border-bottom: none;
}
</style>
@endsection 