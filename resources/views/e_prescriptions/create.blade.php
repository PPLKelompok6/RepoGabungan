@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buat E-Prescription') }}</div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>Detail Appointment</h5>
                        <p><strong>Pasien:</strong> {{ $appointment->patient->name }}</p>
                        <p><strong>Tanggal:</strong> {{ $appointment->appointment_date->format('d M Y H:i') }}</p>
                    </div>

                    <form method="POST" action="{{ route('e-prescriptions.store', $appointment) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="medication_details" class="form-label">{{ __('Detail Obat & Dosis') }}</label>
                            <textarea class="form-control @error('medication_details') is-invalid @enderror" 
                                      id="medication_details" name="medication_details" rows="4" 
                                      required>{{ old('medication_details') }}</textarea>
                            @error('medication_details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">
                                Masukkan detail obat dan dosis yang diresepkan (contoh: Paracetamol 500mg 3x1)
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="instructions" class="form-label">{{ __('Instruksi Penggunaan') }}</label>
                            <textarea class="form-control @error('instructions') is-invalid @enderror" 
                                      id="instructions" name="instructions" rows="3">{{ old('instructions') }}</textarea>
                            @error('instructions')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">{{ __('Catatan Tambahan') }}</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="valid_until" class="form-label">{{ __('Berlaku Sampai') }}</label>
                            <input type="date" class="form-control @error('valid_until') is-invalid @enderror" 
                                   id="valid_until" name="valid_until" 
                                   value="{{ old('valid_until', now()->addDays(7)->format('Y-m-d')) }}">
                            @error('valid_until')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Buat Resep') }}
                            </button>
                            <a href="{{ route('doctor.appointments.history') }}" class="btn btn-secondary">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 