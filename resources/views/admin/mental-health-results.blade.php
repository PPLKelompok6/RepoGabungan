@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-4">Daftar Hasil Tes Mental Health Check Up</h2>
            
            <!-- Filter Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.mental-health.results') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="test_type" class="form-label">Jenis Tes</label>
                            <select name="test_type" id="test_type" class="form-select">
                                <option value="">Semua Jenis</option>
                                <option value="burnout">Burnout</option>
                                <option value="depresi">Depresi</option>
                                <option value="kecemasan">Kecemasan</option>
                                <option value="trauma">Trauma</option>
                                <option value="stres">Stres</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="date_range" class="form-label">Rentang Waktu</label>
                            <select name="date_range" id="date_range" class="form-select">
                                <option value="all">Semua Waktu</option>
                                <option value="today">Hari Ini</option>
                                <option value="week">Minggu Ini</option>
                                <option value="month">Bulan Ini</option>
                                <option value="year">Tahun Ini</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="severity" class="form-label">Tingkat Keparahan</label>
                            <select name="severity" id="severity" class="form-select">
                                <option value="">Semua Level</option>
                                <option value="low">Rendah</option>
                                <option value="medium">Sedang</option>
                                <option value="high">Tinggi</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Tes</h5>
                            <h3 class="mb-0">{{ $totalTests }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Level Rendah</h5>
                            <h3 class="mb-0">{{ $lowRiskTests }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Level Sedang</h5>
                            <h3 class="mb-0">{{ $mediumRiskTests }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Level Tinggi</h5>
                            <h3 class="mb-0">{{ $highRiskTests }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pasien</th>
                                    <th>Jenis Tes</th>
                                    <th>Tanggal</th>
                                    <th>Usia</th>
                                    <th>Gender</th>
                                    <th>Skor</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mentalHealthTests as $index => $test)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $test->user->name }}</td>
                                    <td>{{ ucfirst($test->test_type) }}</td>
                                    <td>{{ $test->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $test->usia }}</td>
                                    <td>{{ $test->gender }}</td>
                                    <td>{{ $test->score }}</td>
                                    <td>
                                        @php
                                            $level = '';
                                            $badge = '';
                                            if ($test->score <= 44) {
                                                $level = 'Rendah';
                                                $badge = 'bg-success';
                                            } elseif ($test->score <= 88) {
                                                $level = 'Sedang';
                                                $badge = 'bg-warning';
                                            } else {
                                                $level = 'Tinggi';
                                                $badge = 'bg-danger';
                                            }
                                        @endphp
                                        <span class="badge {{ $badge }}">{{ $level }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.mental-health.detail', $test->id) }}" 
                                           class="btn btn-sm btn-info text-white me-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.mental-health.history', $test->user_id) }}" 
                                           class="btn btn-sm btn-primary me-2">
                                            <i class="fas fa-history"></i>
                                        </a>
                                        <form action="{{ route('admin.mental-health.destroy', $test->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data tes ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data hasil tes</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-3">
                        {{ $mentalHealthTests->links() }}
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

.table th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

.badge {
    padding: 8px 12px;
    border-radius: 20px;
}

.btn-info {
    background-color: #0dcaf0;
    border-color: #0dcaf0;
}

.btn-info:hover {
    background-color: #31d2f2;
    border-color: #25cff2;
}
</style>
@endsection 