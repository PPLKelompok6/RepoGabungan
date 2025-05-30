@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <!-- Header -->
                    <h1 class="text-center text-primary mb-4">Tes Psikologi {{ ucfirst($type) }}</h1>
                    
                    <div class="bg-light p-4 rounded-3 mb-4">
                        <p class="mb-0">
                            Bagaimana Anda memandang pekerjaan Anda? Apakah Anda kelelahan? 
                            Seberapa mampukah Anda membangun hubungan Anda dengan orang lain? 
                            Sejauh mana diri Anda secara pribadi terpenuhi? Tunjukkan seberapa sering 
                            pernyataan-pernyataan berikut terjadi pada Anda. Pilihlah jawaban yang 
                            paling sesuai dengan diri Anda.
                        </p>
                    </div>

                    <form action="{{ route('mental-health.submit-questions') }}" method="POST">
                        @csrf
                        <input type="hidden" name="test_type" value="{{ $type }}">

                        @foreach($questions as $index => $question)
                        <div class="question-container mb-4">
                            <p class="fw-bold">{{ $index + 1 }}. {{ $question }} <span class="text-danger">*</span></p>
                            <div class="options-container ms-4">
                                @foreach($options as $value => $option)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="q{{ $index + 1 }}" 
                                           id="q{{ $index + 1 }}_{{ $value }}"
                                           value="{{ $value }}" 
                                           required>
                                    <label class="form-check-label" for="q{{ $index + 1 }}_{{ $value }}">
                                        {{ $option }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('mental-health.test', ['type' => $type]) }}" 
                               class="btn btn-outline-primary btn-lg px-4">
                                <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                Submit <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .question-container {
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }
    .question-container:last-child {
        border-bottom: none;
    }
    .form-check-input:checked {
        background-color: #03A9F4;
        border-color: #03A9F4;
    }
    .btn-primary {
        background-color: #03A9F4;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0288D1;
    }
    .btn-outline-primary {
        color: #03A9F4;
        border-color: #03A9F4;
    }
    .btn-outline-primary:hover {
        background-color: #03A9F4;
        color: white;
    }
    .text-primary {
        color: #03A9F4 !important;
    }
    .options-container {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.5rem;
    }
</style>
@endpush
@endsection