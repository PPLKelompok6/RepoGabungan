@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Detail Resep Digital') }}</span>
                    <a href="{{ route('e-prescriptions.download', $prescription) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5>Informasi Resep</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Dokter:</strong> {{ $prescription->doctor->name }}</p>
                                <p><strong>Pasien:</strong> {{ $prescription->patient->name }}</p>
                                <p><strong>Tanggal Konsultasi:</strong> {{ $prescription->appointment->appointment_date->format('d M Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong> 
                                    <span class="badge bg-{{ $prescription->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($prescription->status) }}
                                    </span>
                                </p>
                                <p><strong>Berlaku Sampai:</strong> {{ $prescription->valid_until->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Detail Obat & Dosis</h5>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($prescription->medication_details)) !!}
                        </div>
                    </div>

                    @if($prescription->instructions)
                    <div class="mb-4">
                        <h5>Instruksi Penggunaan</h5>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($prescription->instructions)) !!}
                        </div>
                    </div>
                    @endif

                    @if($prescription->notes)
                    <div class="mb-4">
                        <h5>Catatan Tambahan</h5>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($prescription->notes)) !!}
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        @if(Auth::user()->role === 'doctor')
                            <a href="{{ route('doctor.appointments.history') }}" class="btn btn-secondary">
                                Kembali ke Riwayat Janji Temu
                            </a>
                        @else
                            <a href="{{ route('appointments.history') }}" class="btn btn-secondary">
                                Kembali ke Riwayat Janji Temu
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 