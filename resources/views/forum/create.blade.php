@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Buat Diskusi Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('forum.store') }}" method="POST">
                        @csrf

                        <!-- Status Pertanyaan -->
                        <div class="mb-4">
                            <label class="form-label">PILIH STATUS PERTANYAAN</label>
                            <div class="d-flex justify-content-between gap-3">
                                <div class="status-option flex-grow-1 text-center">
                                    <input type="radio" class="btn-check" name="status" id="publik" value="publik" checked>
                                    <label class="btn btn-outline-primary w-100 py-3" for="publik">
                                        <img src="{{ asset('images/forum/public-icon.png') }}" alt="Publik" class="mb-2" style="width: 80px; height: 80px; object-fit: contain;">
                                        <div>Publik</div>
                                    </label>
                                </div>
                                
                                <div class="status-option flex-grow-1 text-center">
                                    <input type="radio" class="btn-check" name="status" id="anonim" value="anonim">
                                    <label class="btn btn-outline-primary w-100 py-3" for="anonim">
                                        <img src="{{ asset('images/forum/anonymous-icon.png') }}" alt="Anonim" class="mb-2" style="width: 80px; height: 80px; object-fit: contain;">
                                        <div>Anonim</div>
                                    </label>
                                </div>
                                
                                <div class="status-option flex-grow-1 text-center">
                                    <input type="radio" class="btn-check" name="status" id="privasi" value="privasi">
                                    <label class="btn btn-outline-primary w-100 py-3" for="privasi">
                                        <img src="{{ asset('images/forum/private-icon.png') }}" alt="Privasi" class="mb-2" style="width: 80px; height: 80px; object-fit: contain;">
                                        <div>Privasi</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Pilih Topik -->
                        <div class="mb-4">
                            <label for="topic" class="form-label">PILIH TOPIK</label>
                            <select class="form-select" id="topic" name="topic" required>
                                <option value="">Cari dan pilih topik penyakit</option>
                                <option value="berita_balita">Kesehatan Mental</option>
                                <option value="pola_tidur">Pola Tidur</option>
                                <option value="gaya_hidup">Gaya Hidup</option>
                                <option value="relationship">Relationship</option>
                                <option value="Kesehatan_Digital">Kesehatan Digital</option>
                                <option value="Work-Life_Balance)">Work-Life Balance</option>
                            </select>
                        </div>

                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="title" class="form-label">JUDUL</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Detail Pertanyaan -->
                        <div class="mb-4">
                            <label for="content" class="form-label">DETAIL PERTANYAAN</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Kirim Pertanyaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-check:checked + .btn-outline-primary {
    background-color: #e3f2fd;
    border-color: #0d6efd;
}

.status-option img {
    opacity: 0.6;
    transition: opacity 0.3s;
}

.btn-check:checked + .btn-outline-primary img {
    opacity: 1;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
</style>
@endsection