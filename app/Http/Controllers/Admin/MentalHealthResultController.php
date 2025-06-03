<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentalHealthTest;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MentalHealthResultController extends Controller
{
    public function index(Request $request)
    {
        $query = MentalHealthTest::with('user')->latest();

        // Filter berdasarkan jenis tes
        if ($request->test_type) {
            $query->where('test_type', $request->test_type);
        }

        // Filter berdasarkan rentang waktu
        switch ($request->date_range) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }

        // Filter berdasarkan tingkat keparahan
        switch ($request->severity) {
            case 'low':
                $query->where('score', '<=', 44);
                break;
            case 'medium':
                $query->whereBetween('score', [45, 88]);
                break;
            case 'high':
                $query->where('score', '>=', 89);
                break;
        }

        // Hitung statistik
        $totalTests = MentalHealthTest::count();
        $lowRiskTests = MentalHealthTest::where('score', '<=', 44)->count();
        $mediumRiskTests = MentalHealthTest::whereBetween('score', [45, 88])->count();
        $highRiskTests = MentalHealthTest::where('score', '>=', 89)->count();

        $mentalHealthTests = $query->paginate(10);

        return view('admin.mental-health-results', compact(
            'mentalHealthTests',
            'totalTests',
            'lowRiskTests',
            'mediumRiskTests',
            'highRiskTests'
        ));
    }

    public function detail($id)
    {
        $test = MentalHealthTest::with('user')->findOrFail($id);
        
        // Menentukan level dan rekomendasi berdasarkan skor
        if ($test->score <= 44) {
            $level = 'Rendah';
            $recommendations = [
                'Pertahankan keseimbangan kerja dan istirahat yang baik',
                'Lakukan aktivitas yang menyenangkan di luar pekerjaan',
                'Tetap jaga komunikasi yang baik dengan rekan kerja',
                'Rutin melakukan olahraga ringan'
            ];
        } elseif ($test->score <= 88) {
            $level = 'Sedang';
            $recommendations = [
                'Sepertinnya kamu sudah menangani masalah dengan baik. Tetapi, jika kamu kewalahan, bicarakan dengan ahlinya untuk membantumu menemukan solusi',
                'Atur jadwal kerja dan istirahat yang lebih terstruktur',
                'Praktikkan teknik relaksasi atau meditasi',
                'Pertimbangkan untuk berbicara dengan supervisor tentang beban kerja'
            ];
        } else {
            $level = 'Tinggi';
            $recommendations = [
                'Segera cari bantuan profesional untuk mengelola burnout',
                'Evaluasi ulang prioritas dan beban kerja Anda',
                'Ambil waktu cuti jika memungkinkan',
                'Bangun sistem dukungan dari keluarga dan teman',
                'Pertimbangkan untuk berkonsultasi dengan psikolog atau konselor'
            ];
        }

        return view('admin.mental-health-detail', compact('test', 'level', 'recommendations'));
    }

    public function userHistory($user_id)
    {
        $user = User::findOrFail($user_id);
        $histories = MentalHealthTest::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.mental-health-history', compact('histories', 'user'));
    }

    public function destroy($id)
    {
        try {
            $test = MentalHealthTest::findOrFail($id);
            $test->delete();
            return redirect()->route('admin.mental-health.results')
                ->with('success', 'Data tes mental health berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.mental-health.results')
                ->with('error', 'Gagal menghapus data tes mental health.');
        }
    }
} 