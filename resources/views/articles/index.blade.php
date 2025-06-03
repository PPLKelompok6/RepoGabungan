@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Artikel Kesehatan Yang akan mempengaruhi kesehatan kamu</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($articles as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($article->image)
                                <img src="{{ asset($article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/article-placeholder.jpg') }}" class="card-img-top" alt="Placeholder" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text text-muted small">{{ $article->created_at->format('d M Y') }}</p>
                                <p class="card-text">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-secondary btn-sm">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                        <p>Belum ada artikel tersedia.</p>
                    </div>
                @endforelse
            </div>
            <a href="{{ route('pasien.dashboard') }}" class="btn btn-primary mt-2">Back to Dashboard</a>
            <div class="d-flex justify-content-center mt-4">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection