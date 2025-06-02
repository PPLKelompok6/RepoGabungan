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
                                        @php
                                            $profilePicturePath = $doctor->profile_picture;
                                            $imageUrl = $profilePicturePath ? asset('storage/' . $profilePicturePath) : asset('images/default-avatar.png');
                                        @endphp
                                        
                                        <img src="{{ $imageUrl }}" 
                                             alt="{{ $doctor->name }}" 
                                             class="rounded-circle" 
                                             width="100" 
                                             height="100"
                                             style="object-fit: cover;">
                                    </div>
                                    <h5 class="card-title text-center mb-2">{{ $doctor->name }}</h5>
                                    <p class="text-center text-muted mb-3">{{ $doctor->specialization }}</p>
                                    
                                    <div class="schedule-container">
                                        <h6 class="text-primary mb-2">Jadwal Praktik:</h6>
                                        @if($doctor->doctorSchedules->count() > 0)
                                            @foreach($doctor->doctorSchedules as $schedule)
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

                        <!-- Jadwal Dokter -->
                        <div class="mb-3" id="doctorScheduleContainer">
                            <label class="form-label">{{ __('Jadwal Praktik Dokter') }}</label>
                            <div class="alert alert-info">
                                <small>Silakan pilih waktu sesuai jadwal praktik dokter di bawah ini:</small>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody id="scheduleTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">{{ __('Tanggal & Waktu') }}</label>
                            <input type="datetime-local" class="form-control @error('appointment_date') is-invalid @enderror" 
                                   id="appointment_date" name="appointment_date" 
                                   value="{{ old('appointment_date') }}" required>
                            <div id="scheduleHint" class="form-text text-muted">
                                Mohon pilih waktu sesuai jadwal praktik dokter
                            </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const doctorSelect = document.getElementById('doctor_id');
    const scheduleContainer = document.getElementById('doctorScheduleContainer');
    const scheduleTableBody = document.getElementById('scheduleTableBody');
    const appointmentDateInput = document.getElementById('appointment_date');
    const scheduleHint = document.getElementById('scheduleHint');

    // Data jadwal dokter
    const doctorSchedules = @json($doctors->mapWithKeys(function($doctor) {
        return [$doctor->id => $doctor->doctorSchedules->map(function($schedule) {
            return [
                'day' => $schedule->day,
                'start_time' => $schedule->start_time,
                'end_time' => $schedule->end_time
            ];
        })];
    }));

    // Mapping hari dalam Bahasa Inggris ke Indonesia
    const dayMappings = {
        'sunday': 'minggu',
        'monday': 'senin',
        'tuesday': 'selasa',
        'wednesday': 'rabu',
        'thursday': 'kamis',
        'friday': 'jumat',
        'saturday': 'sabtu',
        'minggu': 'sunday',
        'senin': 'monday',
        'selasa': 'tuesday',
        'rabu': 'wednesday',
        'kamis': 'thursday',
        'jumat': 'friday',
        'sabtu': 'saturday'
    };

    // Fungsi untuk format waktu
    function formatTime(timeStr) {
        return timeStr.substring(0, 5);
    }

    // Fungsi untuk menampilkan jadwal dokter
    function showDoctorSchedule(doctorId) {
        const schedules = doctorSchedules[doctorId] || [];
        scheduleTableBody.innerHTML = '';
        
        if (schedules.length > 0) {
            schedules.forEach(schedule => {
                const row = document.createElement('tr');
                // Kapitalisasi huruf pertama hari
                const day = schedule.day.charAt(0).toUpperCase() + schedule.day.slice(1);
                row.innerHTML = `
                    <td>${day}</td>
                    <td>${formatTime(schedule.start_time)}</td>
                    <td>${formatTime(schedule.end_time)}</td>
                `;
                scheduleTableBody.appendChild(row);
            });
            scheduleContainer.style.display = 'block';
        } else {
            scheduleContainer.style.display = 'none';
            scheduleHint.textContent = 'Dokter belum memiliki jadwal praktik';
            scheduleHint.className = 'form-text text-danger';
        }
    }

    // Event listener untuk perubahan dokter
    doctorSelect.addEventListener('change', function() {
        const selectedDoctorId = this.value;
        if (selectedDoctorId) {
            showDoctorSchedule(selectedDoctorId);
            appointmentDateInput.value = '';
        } else {
            scheduleContainer.style.display = 'none';
        }
    });

    // Event listener untuk validasi tanggal dan waktu
    appointmentDateInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const selectedDoctorId = doctorSelect.value;

        if (selectedDoctorId && selectedDate) {
            const dayName = selectedDate.toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
            const indonesianDay = dayMappings[dayName];
            const timeStr = selectedDate.toTimeString().substring(0, 5);
            
            const schedules = doctorSchedules[selectedDoctorId] || [];
            const matchingSchedule = schedules.find(schedule => 
                schedule.day.toLowerCase() === indonesianDay &&
                timeStr >= formatTime(schedule.start_time) &&
                timeStr < formatTime(schedule.end_time)
            );

            if (!matchingSchedule) {
                this.setCustomValidity(`Waktu yang dipilih tidak tersedia dalam jadwal dokter`);
                scheduleHint.textContent = 'Mohon pilih waktu sesuai jadwal praktik dokter';
                scheduleHint.className = 'form-text text-danger';
            } else {
                this.setCustomValidity('');
                scheduleHint.textContent = 'Waktu yang dipilih tersedia';
                scheduleHint.className = 'form-text text-success';
            }
        }
    });

    // Set minimum date dan time
    const now = new Date();
    now.setMinutes(now.getMinutes());
    const yyyy = now.getFullYear();
    const mm = String(now.getMonth() + 1).padStart(2, '0');
    const dd = String(now.getDate()).padStart(2, '0');
    const hh = String(now.getHours()).padStart(2, '0');
    const min = String(now.getMinutes()).padStart(2, '0');
    
    const minDateTime = `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    appointmentDateInput.min = minDateTime;

    // Tampilkan jadwal jika dokter sudah dipilih
    if (doctorSelect.value) {
        showDoctorSchedule(doctorSelect.value);
    } else {
        scheduleContainer.style.display = 'none';
    }
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