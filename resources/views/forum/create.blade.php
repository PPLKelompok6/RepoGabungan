@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Postingan Baru</h1>
    <form action="{{ route('forum.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Buat Postingan</button>
    </form>
</div>
@endsection