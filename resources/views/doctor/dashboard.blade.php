@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Dashboard Dokter</h1>
    <h4 class="mb-4">Selamat Datang, Dr. {{ Auth::user()->name }}!</h4>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pasien</h5>
                    <h2 class="card-text">{{ $totalPatients ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Janji Temu Hari Ini</h5>
                    <h2 class="card-text">{{ $todayAppointments ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Chat Aktif</h5>
                    <h2 class="card-text">{{ $activeChats ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Cepat dengan Icons -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Lihat Jadwal</h5>
                        <p class="card-text text-muted mb-2">Lihat jadwal praktek Anda</p>
                        <a href="{{ route('doctor.schedule') }}" class="btn btn-primary">Lihat Jadwal</a>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-comments fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Chat Pasien</h5>
                        <p class="card-text text-muted mb-2">Konsultasi langsung dengan pasien melalui fitur chat</p>
                        <a href="{{ route('chat.index') }}" class="btn btn-success">Mulai Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
