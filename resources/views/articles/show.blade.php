@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        @if($article->image)
            <img src="{{ asset($article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 300px; object-fit: cover;">
        @endif
        <div class="card-body">
            <h3 class="card-title">{{ $article->title }}</h3>
            <p class="text-muted small">{{ $article->created_at->format('d M Y') }}</p>
            <div class="card-text">
                {!! $article->content !!}
            </div>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3">Kembali ke Menu Artikel</a>
        </div>
    </div>
</div>
@endsection
