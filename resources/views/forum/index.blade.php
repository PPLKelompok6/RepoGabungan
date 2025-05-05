@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar Kiri -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('forum.create') }}" class="btn btn-primary w-100 mb-4">
                        MULAI DISKUSI
                    </a>

                    <div class="search-box mb-4">
                        <input type="text" class="form-control" placeholder="Cari bahasan di sini">
                    </div>

                    <div class="topics">
                        <h6 class="mb-3">TOPIK</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-muted d-flex align-items-center">
                                    <i class="fas fa-newspaper me-2"></i>
                                    Kesehatan Mental
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-muted d-flex align-items-center">
                                    <i class="fas fa-tint me-2"></i>
                                    Pola Tidur
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-muted d-flex align-items-center">
                                    <i class="fas fa-heart me-2"></i>
                                    Gaya Hidup
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-muted d-flex align-items-center">
                                    <i class="fas fa-users me-2"></i>
                                    Work-life Balance
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">TERBARU</h5>
                </div>
                <div class="card-body">
                    @foreach($posts as $post)
                    <div class="forum-post border-bottom py-3">
                        <div class="d-flex">
                            <div class="avatar me-3">
                                @if($post->user && $post->user->avatar)
                                    <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" 
                                         class="rounded-circle"
                                         style="width: 50px; height: 50px; object-fit: cover;"
                                         alt="{{ $post->user->name }}'s avatar">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" 
                                         class="rounded-circle"
                                         style="width: 50px; height: 50px; object-fit: cover;"
                                         alt="Default avatar">
                                @endif
                            </div>
                            <div class="post-content flex-grow-1">
                                <!-- Topik -->
                                <div class="topic-badge mb-2">
                                    <span class="badge bg-primary">{{ $post->topic }}</span>
                                </div>
                                <!-- Judul -->
                                <h6 class="mb-1">
                                    <a href="{{ route('forum.show', $post->id) }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h6>
                                <!-- Konten Preview -->
                                <p class="text-muted mb-2">
                                    {{ \Str::limit($post->content, 150) }}
                                </p>
                                <!-- Meta Info dan Tombol Komentar -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="post-meta small text-muted">
                                        <span>oleh {{ $post->user->name }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $post->views_count ?? 0 }} dilihat</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('forum.show', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-comment me-1"></i>
                                            {{ $post->comments->count() }} komentar
                                        </a>
                                    </div>
                                </div>
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
.forum-post:hover {
    background-color: #f8f9fa;
}

.topic-badge .badge {
    font-size: 0.8rem;
    padding: 0.35em 0.65em;
    background-color: #0047AB !important;
}

.post-content a {
    color: #0047AB;
}

.post-content a:hover {
    color: #003380;
}

.avatar img {
    border: 2px solid #eee;
}

.btn-outline-primary {
    color: #0047AB;
    border-color: #0047AB;
}

.btn-outline-primary:hover {
    background-color: #0047AB;
    color: white;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>
@endsection
