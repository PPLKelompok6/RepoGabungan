@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-primary mb-4">Riwayat Tes Kesehatan Mental</h1>
    
    @if($histories->isEmpty())
        <div class="alert alert-info">
            Anda belum pernah melakukan tes kesehatan mental sebelumnya.
        </div>
    @else
        <div class="row">
            @foreach($histories as $history)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ ucfirst($history->test_type) }}</h5>
                        <p class="text-muted mb-2">Dilakukan pada: {{ $history->created_at->format('d M Y, H:i') }}</p>
                        <p class="mb-3">Skor: {{ $history->score }}</p>
                        @php
                            $category = '';
                            if ($history->score <= 44) {
                                $category = 'Rendah';
                            } elseif ($history->score <= 88) {
                                $category = 'Sedang';
                            } else {
                                $category = 'Tinggi';
                            }
                        @endphp
                        <p class="mb-3">Hasil: {{ $category }}</p>
                        <a href="{{ route('mental-health.test', ['type' => $history->test_type]) }}" 
                           class="btn btn-outline-primary">
                            Lakukan Tes Lagi
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection