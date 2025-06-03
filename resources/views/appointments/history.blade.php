@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Riwayat Janji Temu') }}</h5>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Dokter</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>E-Prescription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment_date->format('d M Y H:i') }}</td>
                                    <td>{{ $appointment->doctor->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $appointment->status === 'pending' ? 'warning' : 
                                            ($appointment->status === 'confirmed' ? 'success' : 
                                            ($appointment->status === 'completed' ? 'info' : 'danger')) 
                                        }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $appointment->notes }}</td>
                                    <td>
                                        @if($appointment->prescription)
                                            <div class="btn-group">
                                                <a href="{{ route('e-prescriptions.show', $appointment->prescription) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <a href="{{ route('e-prescriptions.download', $appointment->prescription) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i> Download PDF
                                                </a>
                                            </div>
                                        @else
                                            @if($appointment->status === 'completed')
                                                <span class="text-muted">Menunggu resep dari dokter</span>
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $appointments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection