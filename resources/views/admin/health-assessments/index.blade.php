@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Tes Kesehatan Pasien</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Tes</th>
                            <th>Data Tes</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($healthAssessments as $assessment)
                        <tr>
                            <td>{{ $assessment->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $assessment->user->name }}</td>
                            <td>
                                @switch($assessment->test_type)
                                    @case('bmi')
                                        <span class="badge bg-primary">BMI</span>
                                        @break
                                    @case('calories')
                                        <span class="badge bg-success">Kalori</span>
                                        @break
                                    @case('diabetes')
                                        <span class="badge bg-warning">Diabetes</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @switch($assessment->test_type)
                                    @case('bmi')
                                        BB: {{ $assessment->test_data['weight'] }}kg, 
                                        TB: {{ $assessment->test_data['height'] }}cm
                                        @break
                                    @case('calories')
                                        Umur: {{ $assessment->test_data['age'] }}, 
                                        Gender: {{ $assessment->test_data['gender'] == 'male' ? 'Pria' : 'Wanita' }}
                                        @break
                                    @case('diabetes')
                                        Umur: {{ $assessment->test_data['age_group'] }}, 
                                        Aktivitas: {{ $assessment->test_data['physical_activity'] == 0 ? 'Aktif' : 'Tidak Aktif' }}
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @switch($assessment->test_type)
                                    @case('bmi')
                                        <strong>BMI:</strong> {{ $assessment->results['bmi'] }}
                                        <br>
                                        <span class="text-muted">{{ $assessment->results['category'] }}</span>
                                        @break
                                    @case('calories')
                                        <strong>BMR:</strong> {{ $assessment->results['bmr'] }} kal
                                        <br>
                                        <strong>TDEE:</strong> {{ $assessment->results['tdee'] }} kal
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
        </div>
    </div>
</div>
@endsection