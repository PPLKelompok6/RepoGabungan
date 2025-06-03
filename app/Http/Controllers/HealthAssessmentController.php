<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthAssessment;

class HealthAssessmentController extends Controller
{
    public function index()
    {
        $assessments = HealthAssessment::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pasien.health-assessments.index', compact('assessments'));
    }

    public function calculate(Request $request)
    {
        $testType = $request->input('test_type');
        $results = [];
        $testData = [];

        switch ($testType) {
            case 'bmi':
                $testData = [
                    'weight' => $request->input('weight'),
                    'height' => $request->input('height')
                ];
                $results = $this->calculateBMI($request);
                break;
            case 'calories':
                $testData = [
                    'weight' => $request->input('weight'),
                    'height' => $request->input('height'),
                    'age' => $request->input('age'),
                    'gender' => $request->input('gender'),
                    'activity_level' => $request->input('activity_level')
                ];
                $results = $this->calculateCalories($request);
                break;
            case 'diabetes':
                $testData = [
                    'age_group' => $request->input('age_group'),
                    'waist_size' => $request->input('waist_size'),
                    'physical_activity' => $request->input('physical_activity'),
                    'family_history' => $request->input('family_history')
                ];
                $results = $this->calculateDiabetesRisk($request);
                break;
        }

        // Store results in database
        HealthAssessment::create([
            'user_id' => auth()->id(),
            'test_type' => $testType,
            'results' => $results,
            'test_data' => $testData
        ]);

        // Add recommendations based on results
        $results['recommendations'] = $this->getRecommendations($testType, $results);

        // Keep the modal open and show results
        return redirect()->back()->with([
            'results' => array_merge(['test_type' => $testType], $results),
            'keepModalOpen' => true,
            'activeTab' => $testType
        ]);
    }

    private function calculateBMI(Request $request)
    {
        $weight = $request->input('weight');
        $height = $request->input('height') / 100; // Convert cm to m
        $bmi = $weight / ($height * $height);

        $category = match(true) {
            $bmi < 18.5 => 'Berat Badan Kurang',
            $bmi < 24.9 => 'Berat Badan Normal',
            $bmi < 29.9 => 'Berat Badan Berlebih',
            default => 'Obesitas'
        };

        return [
            'bmi' => round($bmi, 1),
            'category' => $category,
            'ideal_weight_range' => [
                'min' => round(18.5 * ($height * $height), 1),
                'max' => round(24.9 * ($height * $height), 1)
            ]
        ];
    }

    private function calculateCalories(Request $request)
    {
        $weight = $request->input('weight');
        $height = $request->input('height');
        $age = $request->input('age');
        $gender = $request->input('gender');
        $activityLevel = $request->input('activity_level');

        if ($gender === 'male') {
            $bmr = 88.362 + (13.397 * $weight) + (4.799 * $height) - (5.677 * $age);
        } else {
            $bmr = 447.593 + (9.247 * $weight) + (3.098 * $height) - (4.330 * $age);
        }

        $tdee = $bmr * $activityLevel;
        
        $goals = [
            'weight_loss' => round($tdee - 500),
            'maintenance' => round($tdee),
            'weight_gain' => round($tdee + 500)
        ];

        return [
            'bmr' => round($bmr),
            'tdee' => round($tdee),
            'goals' => $goals
        ];
    }

    private function calculateDiabetesRisk(Request $request)
    {
        $score = 0;
        $score += $request->input('age_group');
        $score += $request->input('waist_size');
        $score += $request->input('physical_activity');
        $score += $request->input('family_history');

        $riskLevel = match(true) {
            $score < 3 => 'Risiko Rendah',
            $score < 8 => 'Risiko Sedang',
            default => 'Risiko Tinggi'
        };

        $riskPercentage = match(true) {
            $score < 3 => '1-5%',
            $score < 8 => '10-17%',
            default => '33-50%'
        };

        return [
            'score' => $score,
            'riskLevel' => $riskLevel,
            'riskPercentage' => $riskPercentage
        ];
    }

    private function getRecommendations($testType, $results)
    {
        switch ($testType) {
            case 'bmi':
                return match($results['category']) {
                    'Berat Badan Kurang' => [
                        'Konsumsi makanan bergizi dengan kalori yang cukup',
                        'Konsultasikan dengan ahli gizi untuk program penambahan berat badan yang sehat',
                        'Lakukan latihan kekuatan untuk membangun massa otot'
                    ],
                    'Berat Badan Normal' => [
                        'Pertahankan pola makan sehat dan seimbang',
                        'Lakukan olahraga rutin minimal 30 menit per hari',
                        'Jaga kualitas tidur yang baik'
                    ],
                    'Berat Badan Berlebih' => [
                        'Kurangi asupan kalori harian',
                        'Tingkatkan aktivitas fisik',
                        'Hindari makanan tinggi gula dan lemak jenuh'
                    ],
                    default => [
                        'Konsultasikan dengan dokter untuk program penurunan berat badan',
                        'Lakukan perubahan gaya hidup secara bertahap',
                        'Rutin melakukan pemeriksaan kesehatan'
                    ]
                };

            case 'calories':
                return [
                    'Untuk menurunkan berat badan: Konsumsi ' . $results['goals']['weight_loss'] . ' kalori/hari',
                    'Untuk mempertahankan: Konsumsi ' . $results['goals']['maintenance'] . ' kalori/hari',
                    'Untuk menaikkan berat badan: Konsumsi ' . $results['goals']['weight_gain'] . ' kalori/hari',
                    'Pastikan asupan protein 1.6-2.2g/kg berat badan',
                    'Konsumsi sayur dan buah minimal 5 porsi per hari'
                ];

            case 'diabetes':
                return match($results['riskLevel']) {
                    'Risiko Rendah' => [
                        'Pertahankan gaya hidup sehat',
                        'Lakukan cek gula darah rutin setiap tahun',
                        'Jaga berat badan ideal'
                    ],
                    'Risiko Sedang' => [
                        'Tingkatkan aktivitas fisik minimal 150 menit per minggu',
                        'Batasi konsumsi gula dan karbohidrat sederhana',
                        'Lakukan cek gula darah setiap 6 bulan'
                    ],
                    default => [
                        'Segera konsultasi dengan dokter',
                        'Lakukan pemeriksaan gula darah menyeluruh',
                        'Ikuti program pencegahan diabetes'
                    ]
                };
        }
    }
}