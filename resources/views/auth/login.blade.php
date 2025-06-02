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
                        <h2 class="fw-bold text-primary">Selamat Datang</h2>
                        <p class="text-muted">Silakan masukkan data akun yang telah terdaftar</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" 
                                placeholder="Masukkan email" autofocus>
                            @error('email')
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
                                    name="password" required autocomplete="current-password"
                                    placeholder="Masukkan password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" 
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                            Masuk
                        </button>

                        <div class="text-center">
                            Belum punya akun? Silakan daftar <a href="{{ route('register') }}" class="text-decoration-none">di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Image Section -->
        <div class="col-md-5 d-none d-md-block">
            <img src="{{ asset('images/hospital2.png') }}" alt="Hospital Illustration" class="img-fluid">
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 15px;
}

.btn-primary {
    background-color: #0D6EFD;
    border-color: #0D6EFD;
}

.btn-primary:hover {
    background-color: #0B5ED7;
    border-color: #0B5ED7;
}

.form-control {
    border-radius: 8px;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #86B7FE;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-check-input:checked {
    background-color: #0D6EFD;
    border-color: #0D6EFD;
}

.text-primary {
    color: #0D6EFD !important;
}

a:hover {
    color: #0B5ED7;
}
</style>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});
</script>
@endsection