@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <!-- Header -->
                    <h1 class="text-center text-primary mb-4">Tes Psikologi {{ ucfirst($type) }}</h1>
                    
                    <p class="text-center mb-5">
                        Pernah merasa kelelahan terus-menerus, kurang produktif dalam pekerjaan, atau merasa lelah secara fisik dan 
                        emosional menghadapi kerjaan? Mungkin kamu mengalami burnout. Dengan melakukan tes ini, kamu dapat melihat 
                        gambaran tingkat burnout serta memahami kondisimu lebih baik, dan juga mengambil langkah selanjutnya untuk 
                        mengatasi burnout.
                    </p>

                    <!-- Form -->
                    <form action="{{ route('mental-health.submit-test') }}" method="POST">
                        @csrf
                        <input type="hidden" name="test_type" value="{{ $type }}">

                        <!-- Usia -->
                        <div class="mb-4">
                            <label for="usia" class="form-label">Usia <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-lg" id="usia" name="usia" required>
                        </div>

                        <!-- Gender -->
                        <div class="mb-4">
                            <label for="gender" class="form-label">Gender biologis <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="gender" name="gender" required>
                                <option value="">Pilih gender</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <!-- Domisili -->
                        <div class="mb-4">
                            <label for="domisili" class="form-label">Domisili/Daerah tempat tinggal saat ini <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="domisili" name="domisili" required>
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-4">
                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="pekerjaan" name="pekerjaan" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-control, .form-select {
        border: 1px solid #ddd;
        padding: 0.75rem 1rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #03A9F4;
        box-shadow: 0 0 0 0.25rem rgba(3, 169, 244, 0.25);
    }
    .btn-primary {
        background-color: #03A9F4;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0288D1;
    }
    .text-primary {
        color: #03A9F4 !important;
    }
</style>
@endpush
@endsection