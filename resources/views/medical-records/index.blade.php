@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Rekam Medis</h2>
        @if(auth()->user()->role === 'doctor')
            <a href="{{ route('medical-records.create') }}" class="btn btn-info text-white">
                <i class="fas fa-plus"></i> Tambah Rekam Medis
            </a>
        @endif
    </div>
    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Tanggal</th>
                            @if(auth()->user()->role === 'doctor')
                                <th scope="col">Pasien</th>
                            @else
                                <th scope="col">Dokter</th>
                            @endif
                            <th scope="col">Diagnosa</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $record)
                            <tr>
                                <td>{{ $record->record_date->format('d/m/Y') }}</td>
                                <td>
                                    @if(auth()->user()->role === 'doctor')
                                        <span class="badge bg-primary">{{ $record->patient->name }}</span>
                                    @else
                                        <span class="badge bg-info text-dark">{{ $record->doctor->name }}</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($record->diagnosis, 50) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('medical-records.show', $record) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada rekam medis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 