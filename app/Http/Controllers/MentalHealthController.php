<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MentalHealthTest;

class MentalHealthController extends Controller
{
    public function index()
    {
        return view('mental-health.index');
    }

    public function history()
    {
        $histories = Auth::user()->mentalHealthTests()
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('mental-health.history', compact('histories'));
    }

    public function test($type)
    {
        return view('mental-health.test', compact('type'));
    }

    public function submitTest(Request $request)
    {
        $request->validate([
            'usia' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'domisili' => 'required|string',
            'pekerjaan' => 'required|string',
            'test_type' => 'required|string'
        ]);
    
        // Simpan data ke session
        session([
            'user_age' => $request->usia,
            'user_gender' => $request->gender,
            'user_domisili' => $request->domisili,
            'user_pekerjaan' => $request->pekerjaan,
            'test_type' => $request->test_type
        ]);
    
        return redirect()->route('mental-health.questions', ['type' => $request->test_type]);
    }

    public function questions($type)
    {
        $questions = [
            'Saya merasakan emosi saya terkuras karena pekerjaan.',
            'Saya merasakan kelelahan fisik yang amat sangat di akhir hari kerja.',
            'Saya merasa lesu ketika bangun pagi karena harus menjalani hari di tempat kerja.',
            'Saya sulit memahami tindakan yang dilakukan rekan-rekan kerja saya.',
            'Saya merasa bahwa saya memperlakukan beberapa rekan kerja seolah-olah mereka adalah objek / barang (impersonal).',
            'Bekerja bersama orang lain seharian penuh membuat saya stres.',
            'Saya gagal mengatasi masalah orang lain.',
            'Saya merasa lelah (burnout) karena pekerjaan saya.',
            'Saya merasa bahwa saya tidak mampu mempengaruhi orang lain secara positif melalui pekerjaan saya.',
            'Saya menjadi lebih tidak berperasaan kepada orang-orang sejak saya mulai melakukan pekerjaan ini.',
            'Saya khawatir pekerjaan saya membuat saya lebih sulit secara emosional.',
            'Saya merasa tidak memiliki energi.',
            'Saya merasa frustrasi dengan pekerjaan saya.',
            'Saya merasa bahwa saya bekerja terlalu keras.',
            'Saya tidak terlalu tertarik dengan apa yang terjadi dengan rekan-rekan saya.',
            'Berhubungan langsung dengan orang-orang di tempat kerja terlalu membuat saya stres.',
            'Saya merasa sulit untuk membangun suasana santai di lingkungan kerja saya.',
            'Saya merasa kehilangan energi ketika saya bekerja sama dengan rekan kerja saya',
            'Dalam pekerjaan saya, saya belum mencapai banyak keberhasilan yang bermanfaat.',
            'Saya merasa seperti kehabisan akal.',
            'Dalam pekerjaan saya, saya tidak mampu menghadapi masalah emosional dengan santai.',
            'Saya merasa rekan kerja saya menyalahkan saya atas beberapa masalah mereka.'
        ];
    
        $options = [
            0 => 'Tidak pernah',
            1 => 'Setidaknya beberapa kali dalam setahun',
            2 => 'Setidaknya sebulan sekali',
            3 => 'Beberapa kali dalam sebulan',
            4 => 'Seminggu sekali',
            5 => 'Beberapa kali seminggu',
            6 => 'Setiap hari'
        ];
    
        return view('mental-health.questions', compact('type', 'questions', 'options'));
    }
    
    public function submitQuestions(Request $request)
    {
        $validationRules = [
            'test_type' => 'required|string'
        ];
    
        // Menambahkan validasi untuk 22 pertanyaan
        for ($i = 1; $i <= 22; $i++) {
            $validationRules['q' . $i] = 'required|integer|between:0,6';
        }
    
        $request->validate($validationRules);
    
        // Hitung total skor
        $totalScore = 0;
        for ($i = 1; $i <= 22; $i++) {
            $totalScore += $request->input('q' . $i);
        }
    
        // Simpan hasil tes ke database
        $mentalHealthTest = MentalHealthTest::create([
            'user_id' => Auth::id(),
            'test_type' => $request->test_type,
            'score' => $totalScore,
            'usia' => session('user_age'),  // Ubah 'age' menjadi 'usia'
            'gender' => session('user_gender'),
            'domisili' => session('user_domisili'),
            'pekerjaan' => session('user_pekerjaan')
        ]);
    
        // Simpan skor ke session untuk halaman hasil
        session(['burnout_score' => $totalScore]);
    
        return redirect()->route('mental-health.result', ['type' => $request->test_type]);
    }

    public function result($type)
    {
        $score = session('burnout_score');
        $age = session('user_age');
        $gender = session('user_gender');
    
        // Kategori burnout berdasarkan skor (total maksimum: 22 pertanyaan x 6 poin = 132)
        // Rendah: 0-44
        // Sedang: 45-88
        // Tinggi: 89-132
        
        $category = '';
        $recommendations = [];
        
        if ($score <= 44) {
            $category = 'Rendah';
            $recommendations = [
                'Pertahankan keseimbangan kerja dan istirahat yang baik',
                'Lakukan aktivitas yang menyenangkan di luar pekerjaan',
                'Tetap jaga komunikasi yang baik dengan rekan kerja',
                'Rutin melakukan olahraga ringan'
            ];
        } elseif ($score <= 88) {
            $category = 'Sedang';
            $recommendations = [
                'Sepertinnya kamu sudah menangani masalah dengan baik. Tetapi, jika kamu kewalahan, bicarakan dengan ahlinya untuk membantumu menemukan solusi',
                'Atur jadwal kerja dan istirahat yang lebih terstruktur',
                'Praktikkan teknik relaksasi atau meditasi',
                'Pertimbangkan untuk berbicara dengan supervisor tentang beban kerja'
            ];
        } else {
            $category = 'Tinggi';
            $recommendations = [
                'Segera cari bantuan profesional untuk mengelola burnout',
                'Evaluasi ulang prioritas dan beban kerja Anda',
                'Ambil waktu cuti jika memungkinkan',
                'Bangun sistem dukungan dari keluarga dan teman',
                'Pertimbangkan untuk berkonsultasi dengan psikolog atau konselor'
            ];
        }
    
        return view('mental-health.result', compact('score', 'category', 'recommendations', 'type', 'age', 'gender'));
    }
}