@extends('layouts.app')
@php 
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="text-center mb-4">
                            @php
                                $profilePicturePath = auth()->user()->profile_picture;
                                $imageUrl = $profilePicturePath ? asset('storage/' . $profilePicturePath) : asset('images/default-avatar.png');
                            @endphp
                            
                            <img id="preview-image"
                                 src="{{ $imageUrl }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="rounded-circle mb-3" 
                                 width="150" 
                                 height="150"
                                 style="object-fit: cover; border: 2px solid #eee;">
                            
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(this)">
                                @error('profile_picture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" readonly>
                            <small class="text-muted">Email cannot be changed</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="{{ route('pasien.dashboard') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 15px;
    border: none;
}

.card-header {
    background-color: transparent;
    border-bottom: 1px solid #eee;
    padding: 20px;
}

.form-control {
    border-radius: 10px;
    padding: 10px 15px;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.btn {
    padding: 10px 20px;
    border-radius: 10px;
}

.btn-primary {
    background-color: #0047AB;
    border-color: #0047AB;
}

.btn-primary:hover {
    background-color: #003380;
    border-color: #003380;
}
</style>

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection 