@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Dashboard Dokter</h1>
    <h4 class="mb-4">Selamat Datang, Dr. {{ Auth::user()->name }}!</h4>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pasien</h5>
                    <h2 class="card-text">{{ $totalPatients ?? 0 }}</h2>
                    <p class="mb-0">Minggu Ini</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Janji Temu</h5>
                    <h2 class="card-text">{{ $upcomingAppointments ?? 0 }}</h2>
                    <p class="mb-0">Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Chat Aktif</h5>
                    <h2 class="card-text">{{ $activeChats ?? 0 }}</h2>
                    <p class="mb-0">Belum Terjawab</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Jadwal Praktik</h5>
                    <h2 class="card-text">{{ $totalSchedules ?? 0 }}</h2>
                    <p class="mb-0">Minggu Ini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Utama -->
    <div class="row g-4">
        <!-- Lihat Jadwal -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Lihat Jadwal</h5>
                        <p class="card-text text-muted mb-2">Lihat jadwal praktik Anda</p>
                        <a href="{{ route('doctor.schedule') }}" class="btn btn-primary">Lihat Jadwal</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambah Jadwal -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-plus-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Tambah Jadwal</h5>
                        <p class="card-text text-muted mb-2">Tambah jadwal praktik baru</p>
                        <a href="{{ route('doctor.schedule.create') }}" class="btn btn-success">Tambah Jadwal</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Janji Temu -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-history fa-2x text-info"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Riwayat Janji Temu</h5>
                        <p class="card-text text-muted mb-2">Lihat riwayat janji temu dengan pasien</p>
                        <a href="{{ route('doctor.appointments.history') }}" class="btn btn-info text-white">Lihat Riwayat</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat dengan Pasien -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-comments fa-2x text-info"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Chat dengan Pasien</h5>
                        <p class="card-text text-muted mb-2">Lihat dan balas chat dari pasien Anda</p>
                        <a href="{{ route('chat.index') }}" class="btn btn-info text-white">Buka Chat</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekam Medis Pasien -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-notes-medical fa-2x text-info"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Rekam Medis Pasien</h5>
                        <p class="card-text text-muted mb-2">Lihat dan tambahkan rekam medis pasien Anda</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('medical-records.create') }}" class="btn btn-info text-white">Tambah Rekam Medis</a>
                            <a href="{{ route('medical-records.index') }}" class="btn btn-outline-info">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Jadwal Hari Ini</h5>
        </div>
        <div class="card-body">
            @if(isset($todayAppointments) && count($todayAppointments) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Nama Pasien</th>
                                <th>Keluhan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todayAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->time }}</td>
                                <td>{{ $appointment->patient_name }}</td>
                                <td>{{ $appointment->complaint }}</td>
                                <td>
                                    <span class="badge bg-{{ $appointment->status_color }}">
                                        {{ $appointment->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('doctor.appointments.show', $appointment->id) }}" 
                                       class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">Tidak ada jadwal janji temu hari ini.</p>
            @endif
        </div>
    </div>

    <!-- Card Chat -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Chat Terbaru</h5>
                </div>
                <div class="card-body">
                    @if(isset($recentChats) && count($recentChats) > 0)
                        <div class="list-group">
                            @foreach($recentChats as $chat)
                                <a href="{{ route('chat.show', $chat->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $chat->user->name }}</h6>
                                            <p class="mb-1 text-muted">{{ Str::limit($chat->last_message, 50) }}</p>
                                        </div>
                                        <small class="text-muted">{{ $chat->updated_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('chat.index') }}" class="btn btn-primary">Lihat Semua Chat</a>
                        </div>
                    @else
                        <p class="text-center mb-0">Belum ada chat terbaru</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
    border: none;
    border-radius: 15px;
}

.card:hover {
    transform: translateY(-5px);
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.05);
}

.btn {
    border-radius: 10px;
    padding: 8px 20px;
}

.shadow-sm {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.badge {
    padding: 8px 12px;
    font-weight: 500;
}

.list-group-item {
    border: none;
    border-radius: 8px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.list-group-item:last-child {
    margin-bottom: 0;
}
</style>
@endsection