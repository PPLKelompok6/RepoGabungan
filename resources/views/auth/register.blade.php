@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-center">
        <!-- Form Section -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="MedFast Logo" height="60" class="mb-3">
                        <h2 class="fw-bold">Buat Akun Pengguna</h2>
                        <p class="text-muted">Silakan masukkan data akun untuk melakukan pendaftaran</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" 
                                placeholder="Masukkan nama lengkap" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" 
                                placeholder="Masukkan email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Role Field -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Daftar Sebagai</label>
                            <select id="role" class="form-control @error('role') is-invalid @enderror" 
                                name="role" required>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pasien</option>
                                <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Dokter</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="new-password"
                                    placeholder="Masukkan password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Panjang password minimal 8 karakter dan terdapat minimal 1 huruf kapital</small>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control" 
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Masukkan ulang password">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            Daftar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Image Section -->
        <div class="col-md-5 d-none d-md-block">
            <img src="{{ asset('images/hospital.jpg') }}" alt="Hospital Illustration" class="img-fluid">
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 15px;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

.form-control {
    border-radius: 8px;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Tambahan styling untuk select */
select.form-control {
    appearance: auto;
    padding-right: 2rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#password-confirm');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});
</script>
@endsection