<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthAssessment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $healthAssessments = HealthAssessment::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('healthAssessments'));
    }

    public function healthAssessments()
    {
        $healthAssessments = HealthAssessment::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.health-assessments.index', compact('healthAssessments'));
    }
}