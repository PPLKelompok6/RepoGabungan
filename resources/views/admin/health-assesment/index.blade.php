@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Riwayat Tes Kesehatan Pasien</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pasien</th>
                            <th>Jenis Tes</th>
                            <th>Hasil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assessments as $assessment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $assessment->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $assessment->user->name }}</td>
                            <td>
                                @switch($assessment->test_type)
                                    @case('bmi')
                                        <span class="badge bg-primary">BMI</span>
                                        @break
                                    @case('calories')
                                        <span class="badge bg-info">Kalori</span>
                                        @break
                                    @case('diabetes')
                                        <span class="badge bg-warning">Diabetes</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @switch($assessment->test_type)
                                    @case('bmi')
                                        BMI: {{ $assessment->results['bmi'] }}<br>
                                        <small>{{ $assessment->results['category'] }}</small>
                                        @break
                                    @case('calories')
                                        BMR: {{ $assessment->results['bmr'] }} kal/hari<br>
                                        <small>TDEE: {{ $assessment->results['tdee'] }} kal/hari</small>
                                        @break
                                    @case('diabetes')
                                        Risiko: {{ $assessment->results['riskLevel'] }}<br>
                                        <small>Skor: {{ $assessment->results['score'] }}</small>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <form action="{{ route('admin.health-assessments.destroy', $assessment->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus hasil tes ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data tes kesehatan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $assessments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection