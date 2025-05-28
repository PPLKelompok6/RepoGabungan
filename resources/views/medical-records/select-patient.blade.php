@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Pilih Pasien</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('medical-records.index') }}" method="GET">
                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Pilih Pasien</label>
                            <select name="patient_id" id="patient_id" class="form-select" required>
                                <option value="">-- Pilih Pasien --</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-info text-white">Lihat Riwayat</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 