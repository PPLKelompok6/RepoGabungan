@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Dashboard Pasien</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h4>Selamat Datang, {{ Auth::user()->name }}!</h4>
                    
                    <div class="mt-4">
                        <h5>Menu Cepat</h5>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-calendar-plus text-primary"></i> Buat Janji Temu
                                        </h5>
                                        <p class="card-text">Buat janji temu dengan dokter pilihan Anda</p>
                                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                                            Buat Janji
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-history text-info"></i> Riwayat Janji Temu
                                        </h5>
                                        <p class="card-text">Lihat riwayat janji temu Anda</p>
                                        <a href="{{ route('appointments.history') }}" class="btn btn-info text-white">
                                            Lihat Riwayat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-comments text-success"></i> Chat Dokter
                                        </h5>
                                        <p class="card-text">Konsultasi langsung dengan dokter melalui fitur chat</p>
                                        <a href="{{ route('chat.index') }}" class="btn btn-success text-white">
                                            Mulai Chat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add new Health Assessment card -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-heartbeat text-danger"></i> Tes Kesehatan
                                        </h5>
                                        <p class="card-text">Hitung BMI, Kalori, dan Cek Risiko Kesehatan Anda</p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#healthAssessmentModal">
                                                Mulai Tes
                                            </button>
                                            <a href="{{ route('health-assessments.index') }}" class="btn btn-outline-danger">
                                                Lihat Riwayat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-comments-alt text-warning"></i> Healthcare Forum
                                        </h5>
                                        <p class="card-text">Diskusi dan berbagi pengalaman dengan sesama pasien</p>
                                        <a href="{{ route('forum.index') }}" class="btn btn-warning text-white">
                                            Masuk Forum
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Health Assessment Modal -->
    <div class="modal fade" id="healthAssessmentModal" tabindex="-1" aria-labelledby="healthAssessmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="healthAssessmentModalLabel">Tes Kesehatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- In the modal section, add this script at the bottom -->
                @if(session('keepModalOpen'))
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var healthModal = new bootstrap.Modal(document.getElementById('healthAssessmentModal'));
                    healthModal.show();
                    
                    // Activate the correct tab
                    var activeTab = '{{ session('activeTab') }}';
                    var tabElement = document.querySelector('#healthTab button[data-bs-target="#' + activeTab + '"]');
                    if (tabElement) {
                        var tab = new bootstrap.Tab(tabElement);
                        tab.show();
                    }
                });
                </script>
                @endif
                
                <!-- Update the results section in the modal -->
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="healthTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="bmi-tab" data-bs-toggle="tab" data-bs-target="#bmi" type="button" role="tab">Kalkulator BMI</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="calories-tab" data-bs-toggle="tab" data-bs-target="#calories" type="button" role="tab">Kalkulator Kalori</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="diabetes-tab" data-bs-toggle="tab" data-bs-target="#diabetes" type="button" role="tab">Tes Risiko Diabetes</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="healthTabContent">
                        <!-- BMI Calculator Tab -->
                        <div class="tab-pane fade show active" id="bmi" role="tabpanel">
                            <form id="bmiForm" action="{{ route('health-assessment.calculate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="test_type" value="bmi">
                                <div class="mb-3">
                                    <label class="form-label">Berat Badan (kg)</label>
                                    <input type="number" step="0.1" class="form-control" name="weight" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" step="0.1" class="form-control" name="height" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Hitung BMI</button>
                            </form>
                        </div>

                        <!-- Calorie Calculator Tab -->
                        <div class="tab-pane fade" id="calories" role="tabpanel">
                            <form id="calorieForm" action="{{ route('health-assessment.calculate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="test_type" value="calories">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Umur</label>
                                        <input type="number" class="form-control" name="age" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-control" name="gender" required>
                                            <option value="male">Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Berat Badan (kg)</label>
                                        <input type="number" step="0.1" class="form-control" name="weight" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tinggi Badan (cm)</label>
                                        <input type="number" step="0.1" class="form-control" name="height" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aktivitas Harian</label>
                                    <select class="form-control" name="activity_level" required>
                                        <option value="1.2">Sangat Jarang Olahraga</option>
                                        <option value="1.375">Olahraga Ringan (1-3x/minggu)</option>
                                        <option value="1.55">Olahraga Sedang (3-5x/minggu)</option>
                                        <option value="1.725">Olahraga Berat (6-7x/minggu)</option>
                                        <option value="1.9">Olahraga Sangat Berat (2x/hari)</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Hitung Kalori</button>
                            </form>
                        </div>

                        <!-- Diabetes Risk Test Tab -->
                        <div class="tab-pane fade" id="diabetes" role="tabpanel">
                            <form id="diabetesForm" action="{{ route('health-assessment.calculate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="test_type" value="diabetes">
                                <div class="mb-3">
                                    <label class="form-label">Umur</label>
                                    <select class="form-control" name="age_group" required>
                                        <option value="0">Di bawah 45 tahun</option>
                                        <option value="2">45-54 tahun</option>
                                        <option value="3">55-64 tahun</option>
                                        <option value="4">Di atas 64 tahun</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lingkar Pinggang</label>
                                    <select class="form-control" name="waist_size" required>
                                        <option value="0">Pria < 90 cm / Wanita < 80 cm</option>
                                        <option value="3">Pria 90-100 cm / Wanita 80-90 cm</option>
                                        <option value="4">Pria > 100 cm / Wanita > 90 cm</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aktivitas Fisik (30 menit/hari)</label>
                                    <select class="form-control" name="physical_activity" required>
                                        <option value="0">Ya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Riwayat Diabetes Keluarga</label>
                                    <select class="form-control" name="family_history" required>
                                        <option value="0">Tidak Ada</option>
                                        <option value="3">Ya (Kakek/Nenek/Sepupu)</option>
                                        <option value="5">Ya (Orangtua/Saudara)</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cek Risiko</button>
                            </form>
                        </div>
                    </div>

                    <!-- Results Section -->
                    @if(session('results'))
                    <div class="mt-4">
                        <div class="alert alert-info">
                            <h5>Hasil Tes:</h5>
                            @if(session('results.test_type') === 'bmi')
                                <p>BMI Anda: {{ session('results.bmi') }}</p>
                                <p>Kategori: {{ session('results.category') }}</p>
                                <p>Berat Badan Ideal: {{ session('results.ideal_weight_range.min') }} - {{ session('results.ideal_weight_range.max') }} kg</p>
                            @elseif(session('results.test_type') === 'calories')
                                <p>BMR: {{ session('results.bmr') }} kalori/hari</p>
                                <p>TDEE: {{ session('results.tdee') }} kalori/hari</p>
                                <p>Target Kalori:</p>
                                <ul>
                                    <li>Penurunan BB: {{ session('results.goals.weight_loss') }} kalori/hari</li>
                                    <li>Pemeliharaan: {{ session('results.goals.maintenance') }} kalori/hari</li>
                                    <li>Penambahan BB: {{ session('results.goals.weight_gain') }} kalori/hari</li>
                                </ul>
                            @elseif(session('results.test_type') === 'diabetes')
                                <p>Tingkat Risiko: {{ session('results.riskLevel') }}</p>
                                <p>Skor: {{ session('results.score') }}</p>
                                <p>Persentase Risiko: {{ session('results.riskPercentage') }}</p>
                            @endif

                            @if(session('results.recommendations'))
                            <h6 class="mt-3">Rekomendasi:</h6>
                            <ul>
                                @foreach(session('results.recommendations') as $recommendation)
                                    <li>{{ $recommendation }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection