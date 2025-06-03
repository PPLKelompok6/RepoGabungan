@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Detail Pertanyaan -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Header dengan Avatar dan Info Dasar -->
                    <div class="d-flex align-items-center mb-3">
                        @if($post->user && $post->user->avatar)
                            <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" 
                                 class="rounded-circle me-2"
                                 style="width: 40px; height: 40px; object-fit: cover;"
                                 alt="{{ $post->user->name }}'s avatar">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" 
                                 class="rounded-circle me-2"
                                 style="width: 40px; height: 40px; object-fit: cover;"
                                 alt="Default avatar">
                        @endif
                        <div class="flex-grow-1">
                            <!-- Topik -->
                            <div class="topic-badge mb-1">
                                <span class="badge bg-primary">{{ $post->topic }}</span>
                            </div>
                            <!-- Judul -->
                            <h5 class="mb-0">{{ $post->title }}</h5>
                            <!-- Info Penulis dan Waktu -->
                            <small class="text-muted">
                                oleh {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                                • {{ $post->views_count ?? 0 }} kali dilihat
                            </small>
                        </div>
                    </div>

                    <!-- Konten Pertanyaan -->
                    <div class="post-content mb-4">
                        <p class="mb-0">{{ $post->content }}</p>
                    </div>
                    
                    <!-- Tombol Komentar -->
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#commentForm">
                        <i class="fas fa-comment me-1"></i> Tulis Komentar
                    </button>

                    <!-- Form Komentar (Collapsible) -->
                    <div class="collapse mt-3" id="commentForm">
                        <div class="card card-body">
                            <!-- Form Komentar -->
                            <form action="{{ route('forum.comment.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea class="form-control" name="comment" rows="3" placeholder="Tulis komentar Anda di sini..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Komentar -->
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Komentar ({{ $post->comments->count() }})</h6>
                </div>
                <div class="card-body">
                    @foreach($post->comments as $comment)
                    <div class="comment-item mb-3 pb-3 border-bottom">
                        <div class="d-flex">
                            @if($comment->user && $comment->user->avatar)
                                <img src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" 
                                     class="rounded-circle me-2"
                                     style="width: 32px; height: 32px; object-fit: cover;"
                                     alt="{{ $comment->user->name }}'s avatar">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" 
                                     class="rounded-circle me-2"
                                     style="width: 32px; height: 32px; object-fit: cover;"
                                     alt="Default avatar">
                            @endif
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0 mt-1">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.comment-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.btn-primary {
    background-color: #0047AB;
    border-color: #0047AB;
}

.btn-primary:hover {
    background-color: #003380;
    border-color: #003380;
}

.topic-badge .badge {
    font-size: 0.8rem;
    padding: 0.35em 0.65em;
    background-color: #0047AB !important;
}

.post-content {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    margin: 1rem 0;
}
</style>
@endsection

<div class="post-meta text-muted mb-3">
    <span>oleh {{ $post->user->name }}</span>
    <span class="mx-2">•</span>
    <span>{{ $post->created_at->diffForHumans() }}</span>
    <span class="mx-2">•</span>
    <span>{{ $post->views_count ?? 0 }} kali dilihat</span>
</div>