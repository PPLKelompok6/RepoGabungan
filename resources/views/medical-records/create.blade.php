@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Tambah Rekam Medis</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('medical-records.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Pasien</label>
                            <select name="patient_id" id="patient_id" class="form-select @error('patient_id') is-invalid @enderror">
                                <option value="">Pilih Pasien</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="record_date" class="form-label">Tanggal Pemeriksaan</label>
                            <input type="date" name="record_date" id="record_date" value="{{ old('record_date') }}" class="form-control @error('record_date') is-invalid @enderror">
                            @error('record_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="diagnosis" class="form-label">Diagnosa</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3" class="form-control @error('diagnosis') is-invalid @enderror" placeholder="Masukkan diagnosa...">{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="recommendation" class="form-label">Saran</label>
                            <textarea name="recommendation" id="recommendation" rows="3" class="form-control @error('recommendation') is-invalid @enderror" placeholder="Masukkan saran...">{{ old('recommendation') }}</textarea>
                            @error('recommendation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-info text-white px-4">Simpan Rekam Medis</button>
                            <a href="{{ route('medical-records.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 