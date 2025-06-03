@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kelola Artikel</h5>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Artikel
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada artikel</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection