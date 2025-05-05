<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthAssessment;
use App\Models\Article;

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
        
        return view('admin.dashboard', compact('totalArticles', 'latestArticles', 'healthAssessments'));
    }

    public function healthAssessments()
    {
        $healthAssessments = HealthAssessment::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.health-assessments.index', compact('healthAssessments'));
    }
}