@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forum</h1>
    <a href="{{ route('forum.create') }}" class="btn btn-primary mb-3">Buat Postingan Baru</a>
    <div class="list-group">
        @foreach($posts as $post)
            <a href="{{ route('forum.show', $post->id) }}" class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ $post->title }}</h5>
                <p class="mb-1">{{ Str::limit($post->content, 100) }}</p>
                <small>Oleh: {{ $post->user->name }}</small>
            </a>
        @endforeach
    </div>
</div>
@endsection