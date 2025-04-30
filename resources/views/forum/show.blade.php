@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <small>Oleh: {{ $post->user->name }}</small>

    <h3>Komentar</h3>
    <form action="{{ route('forum.comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="comment" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
    </form>

    <div class="mt-4">
        @foreach($post->comments as $comment)
            <div class="border p-2 mb-2">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->comment }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection