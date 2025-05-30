@extends('layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="container">
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

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Profil</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-avatar.png') }}" 
                             alt="Profile Picture" 
                             class="rounded-circle mb-3" 
                             style="width: 200px; height: 200px; object-fit: cover;"
                             id="preview-image"
                             onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Ubah Foto Profil</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(this)">
                            @error('profile_picture')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>

                        <div class="mb-3">
                            <label for="specialization" class="form-label">Spesialisasi</label>
                            <select class="form-select" id="specialization" name="specialization" required>
                                <option value="">Pilih Spesialisasi</option>
                                <option value="Dokter Umum" {{ Auth::user()->specialization == 'Dokter Umum' ? 'selected' : '' }}>Dokter Umum</option>
                                <option value="Dokter Gigi" {{ Auth::user()->specialization == 'Dokter Gigi' ? 'selected' : '' }}>Dokter Gigi</option>
                                <option value="Psikologis" {{ Auth::user()->specialization == 'Psikologis' ? 'selected' : '' }}>Psikologis</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

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