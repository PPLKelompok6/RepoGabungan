@extends('layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4 class="mb-4">Daftar Dokter</h4>
            <div class="row mb-5">
                @if($doctors->count() > 0)
                    @foreach($doctors as $doctor)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <img src="{{ $doctor->profile_picture ? Storage::url($doctor->profile_picture) : asset('images/default-avatar.png') }}" 
                                             alt="{{ $doctor->name }}" 
                                             class="rounded-circle" 
                                             width="100" 
                                             height="100"
                                             onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                                    </div>
                                    <h5 class="card-title text-center mb-2">{{ $doctor->name }}</h5>
                                    <p class="text-center text-muted mb-3">{{ $doctor->specialization }}</p>
                                    
                                    <div class="schedule-container">
                                        <h6 class="text-primary mb-2">Jadwal Praktik:</h6>
                                        @if($doctor->schedules->count() > 0)
                                            @foreach($doctor->schedules as $schedule)
                                                <div class="schedule-item mb-2 p-2 border rounded">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="fw-bold">{{ ucfirst($schedule->day) }}</span>
                                                        <span>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted small">Belum ada jadwal tersedia</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p class="text-muted text-center">Tidak ada dokter yang tersedia saat ini.</p>
                    </div>
                @endif
            </div>

            <!-- Appointment Form -->
            <div class="card">
                <div class="card-header">{{ __('Buat Janji Temu') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="doctor_id" class="form-label">{{ __('Pilih Dokter') }}</label>
                            <select name="doctor_id" id="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required>
                                <option value="">{{ __('-- Pilih Dokter --') }}</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">{{ __('Tanggal & Waktu') }}</label>
                            <input type="datetime-local" class="form-control @error('appointment_date') is-invalid @enderror" 
                                   id="appointment_date" name="appointment_date" 
                                   value="{{ old('appointment_date') }}" required>
                            <small class="text-muted">Pilih waktu sesuai jadwal dokter yang tersedia</small>
                            @error('appointment_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">{{ __('Catatan') }}</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Buat Janji Temu') }}
                            </button>
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.schedule-container {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
}

.schedule-item {
    background-color: white;
    transition: all 0.3s ease;
}

.schedule-item:hover {
    background-color: #e9ecef;
}
</style>
@endsection

@push('scripts')
<script>
    // Set minimum date to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const yyyy = today.getFullYear();
        const hours = String(today.getHours()).padStart(2, '0');
        const minutes = String(today.getMinutes()).padStart(2, '0');
        
        const minDateTime = yyyy + '-' + mm + '-' + dd + 'T' + hours + ':' + minutes;
        document.getElementById('appointment_date').min = minDateTime;
    });
</script>
@endpush

<style>
.card {
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card-body img.rounded-circle {
    object-fit: cover;
    border: 1px solid #eee;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: box-shadow 0.3s ease;
}
</style>