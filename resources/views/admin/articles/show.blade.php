@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Artikel</h5>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            @if($article->image)
                <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="img-fluid mb-4" style="max-height: 300px;">
            @endif
            
            <h2>{{ $article->title }}</h2>
            <p class="text-muted">Dibuat pada: {{ $article->created_at->format('d M Y H:i') }}</p>
            
            <div class="article-content mt-4">
                {!! $article->content !!}
            </div>
        </div>
    </div>
</div>
@endsection