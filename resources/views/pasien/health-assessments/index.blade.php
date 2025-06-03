@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Tes Kesehatan</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#healthAssessmentModal">
                        Tes Baru
                    </button>
                </div>
                <div class="card-body">
                    @if($assessments->isEmpty())
                        <div class="alert alert-info">
                            Belum ada riwayat tes kesehatan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Tes</th>
                                        <th>Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assessments as $assessment)
                                    <tr>
                                        <td>{{ $assessment->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @switch($assessment->test_type)
                                                @case('bmi')
                                                    <span class="badge bg-primary">BMI</span>
                                                    @break
                                                @case('calories')
                                                    <span class="badge bg-success">Kalori Harian</span>
                                                    @break
                                                @case('diabetes')
                                                    <span class="badge bg-warning">Risiko Diabetes</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($assessment->test_type)
                                                @case('bmi')
                                                    <strong>BMI:</strong> {{ $assessment->results['bmi'] }}
                                                    <br>
                                                    <span class="text-muted">Kategori: {{ $assessment->results['category'] }}</span>
                                                    @break
                                                @case('calories')
                                                    <strong>BMR:</strong> {{ $assessment->results['bmr'] }} kal/hari
                                                    <br>
                                                    <strong>TDEE:</strong> {{ $assessment->results['tdee'] }} kal/hari
                                                    @break
                                                @case('diabetes')
                                                    <strong>{{ $assessment->results['riskLevel'] }}</strong>
                                                    <br>
                                                    <span class="text-muted">Skor: {{ $assessment->results['score'] }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include your existing health assessment modal here -->
@endsection