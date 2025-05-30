@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="mb-1">Riwayat Tes Kesehatan Mental</h2>
                            <p class="text-muted mb-0">Pasien: {{ $user->name }}</p>
                        </div>
                        <a href="{{ route('admin.mental-health.results') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    @if($histories->isEmpty())
                        <div class="alert alert-info">
                            Pasien belum pernah melakukan tes kesehatan mental.
                        </div>
                    @else
                        <div class="row">
                            @foreach($histories as $history)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="card-title text-primary">{{ ucfirst($history->test_type) }}</h5>
                                            @php
                                                $level = '';
                                                $badge = '';
                                                if ($history->score <= 44) {
                                                    $level = 'Rendah';
                                                    $badge = 'bg-success';
                                                } elseif ($history->score <= 88) {
                                                    $level = 'Sedang';
                                                    $badge = 'bg-warning';
                                                } else {
                                                    $level = 'Tinggi';
                                                    $badge = 'bg-danger';
                                                }
                                            @endphp
                                            <span class="badge {{ $badge }}">{{ $level }}</span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <div class="progress" style="height: 15px;">
                                                <div class="progress-bar bg-success" style="width: 33%"></div>
                                                <div class="progress-bar bg-warning" style="width: 33%"></div>
                                                <div class="progress-bar bg-danger" style="width: 34%"></div>
                                            </div>
                                            <div class="position-relative">
                                                <div class="position-absolute" 
                                                     style="left: {{ ($history->score/132) * 100 }}%; transform: translateX(-50%); top: 5px;">
                                                    <i class="fas fa-caret-up text-dark"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="mb-1"><strong>Skor:</strong></p>
                                                <h4 class="mb-0">{{ $history->score }}</h4>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="mb-1"><strong>Tanggal Tes:</strong></p>
                                                <p class="mb-0">{{ $history->created_at->format('d M Y') }}</p>
                                                <small class="text-muted">{{ $history->created_at->format('H:i') }}</small>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="border rounded p-2">
                                                    <small class="d-block text-muted">Usia</small>
                                                    <strong>{{ $history->usia }} tahun</strong>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border rounded p-2">
                                                    <small class="d-block text-muted">Gender</small>
                                                    <strong>{{ $history->gender }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border rounded p-2">
                                                    <small class="d-block text-muted">Domisili</small>
                                                    <strong>{{ $history->domisili }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="border rounded p-2">
                                                    <small class="d-block text-muted">Pekerjaan</small>
                                                    <strong>{{ $history->pekerjaan }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 text-end">
                                            <a href="{{ route('admin.mental-health.detail', $history->id) }}" 
                                               class="btn btn-sm btn-primary">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
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
    padding: 8px 12px;
}

.border {
    border-color: #dee2e6 !important;
}

.rounded {
    border-radius: 10px !important;
}
</style>
@endsection 