@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Resep Digital</h5>
                    <div class="btn-group">
                        <a href="{{ route('e-prescriptions.history', ['sort' => 'desc']) }}" 
                           class="btn btn-sm {{ $sort === 'desc' ? 'btn-light' : 'btn-outline-light' }}">
                            <i class="fas fa-sort-amount-down"></i> Terbaru
                        </a>
                        <a href="{{ route('e-prescriptions.history', ['sort' => 'asc']) }}" 
                           class="btn btn-sm {{ $sort === 'asc' ? 'btn-light' : 'btn-outline-light' }}">
                            <i class="fas fa-sort-amount-up"></i> Terlama
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($prescriptions->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-prescription fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada resep digital yang tersedia.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Dokter</th>
                                        <th>Diagnosa</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prescriptions as $prescription)
                                        <tr>
                                            <td>{{ $prescription->created_at->format('d M Y') }}</td>
                                            <td>{{ $prescription->appointment->doctor->name }}</td>
                                            <td>{{ $prescription->diagnosis }}</td>
                                            <td>
                                                @if($prescription->status === 'completed')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i> Sudah Dilaksanakan
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-clock me-1"></i> Belum Dilaksanakan
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('e-prescriptions.show', $prescription->id) }}" 
                                                       class="btn btn-sm btn-info text-white">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <a href="{{ route('e-prescriptions.download', $prescription->id) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-download"></i> Unduh PDF
                                                    </a>
                                                    @if($prescription->status === 'active')
                                                        <form action="{{ route('e-prescriptions.update-status', $prescription->id) }}" 
                                                              method="POST" 
                                                              class="d-inline">
                                                            @csrf
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-success"
                                                                    onclick="return confirm('Apakah Anda yakin resep ini sudah dilaksanakan?')">
                                                                <i class="fas fa-check"></i> Tandai Selesai
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
}

.card-header {
    border-top-left-radius: 15px !important;
    border-top-right-radius: 15px !important;
}

.table th {
    border-top: none;
    background-color: #f8f9fa;
}

.btn-sm {
    border-radius: 20px;
    padding: 0.25rem 0.8rem;
    margin: 0 2px;
}

.btn-group .btn {
    border-radius: 20px;
}

.btn-outline-light:hover {
    color: #0d6efd;
    background-color: #fff;
}

.btn-light {
    color: #0d6efd;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
}
</style>
@endsection 