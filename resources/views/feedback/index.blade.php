@extends('layouts.app')


@section('content')
<div class="container">
    <h2>Feedback dan Rating</h2>
    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="rating">Rating</label>
            <div class="rating-options">
                <input type="radio" id="rating1" name="rating" value="1" required />
                <label for="rating1">1</label>
                <input type="radio" id="rating2" name="rating" value="2" />
                <label for="rating2">2</label>
                <input type="radio" id="rating3" name="rating" value="3" />
                <label for="rating3">3</label>
                <input type="radio" id="rating4" name="rating" value="4" />
                <label for="rating4">4</label>
                <input type="radio" id="rating5" name="rating" value="5" />
                <label for="rating5">5</label>
            </div>
        </div>
        <div class="form-group">
            <label for="comment">Komentar</label>
            <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Feedback</button>
    </form>


    <h3 class="mt-4">Daftar Feedback</h3>
    <ul class="list-group">
        @foreach($feedbacks as $feedback)
            <li class="list-group-item">
                <strong>{{ $feedback->user->name }}</strong> ({{ $feedback->rating }} stars)
                <p>{{ $feedback->comment }}</p>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .rating-options {
        display: flex;
        gap: 10px; /*Jarak pilihan*/
    }
    .rating-options input {
        display: none; /* Sembunyikan input radio */
    }
    .rating-options label {
        font-size: 20px;
        color: #007bff; /* Warna teks untuk rating */
        cursor: pointer;
        border: 1px solid #007bff; /* Border untuk pilihan */
        padding: 5px 10px; /* Padding untuk tampilan */
        border-radius: 5px; /* Sudut membulat */
        transition: background-color 0.3s; /* Transisi untuk efek hover */
    }
    .rating-options input:checked + label {
        background-color: #007bff; /* Warna latar belakang untuk pilihan yang dipilih */
        color: white; /* Warna teks untuk pilihan yang dipilih */
    }
    .rating-options label:hover {
        background-color: #e7f1ff; /* Warna latar belakang saat hover */
    }
</style>
@endsection