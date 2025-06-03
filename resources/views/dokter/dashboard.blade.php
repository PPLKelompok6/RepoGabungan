@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Dokter</h1>
    <p>Selamat datang, dokter!</p>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Fitur Chat</h5>
                </div>
                <div class="card-body">
                    <p>Mulai konsultasi dengan pasien melalui fitur chat telemedicine.</p>
                    <a href="{{ route('admin.chat.index') }}" class="btn btn-primary">
                        <i class="fas fa-comments me-2"></i>Buka Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection