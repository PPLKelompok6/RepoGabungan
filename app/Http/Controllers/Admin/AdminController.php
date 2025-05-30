<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthAssessment;
use App\Models\Article;
use App\Models\MentalHealthTest;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalArticles = Article::count();
        $latestArticles = Article::latest()->take(5)->get();
        $healthAssessments = HealthAssessment::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $mentalHealthTests = MentalHealthTest::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalArticles', 
            'latestArticles', 
            'healthAssessments',
            'mentalHealthTests'
        ));
    }

    public function healthAssessments()
    {
        $healthAssessments = HealthAssessment::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.health-assessments.index', compact('healthAssessments'));
    }

    public function mentalHealthResults()
    {
        $mentalHealthTests = MentalHealthTest::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate statistics
        $totalTests = MentalHealthTest::count();
        $lowRiskTests = MentalHealthTest::where('score', '<=', 44)->count();
        $mediumRiskTests = MentalHealthTest::whereBetween('score', [45, 88])->count();
        $highRiskTests = MentalHealthTest::where('score', '>=', 89)->count();

        return view('admin.mental-health-results', compact(
            'mentalHealthTests',
            'totalTests',
            'lowRiskTests',
            'mediumRiskTests',
            'highRiskTests'
        ));
    }
}