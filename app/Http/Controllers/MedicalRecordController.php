<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role === 'doctor') {
            if ($request->filled('patient_id')) {
                $records = MedicalRecord::where('doctor_id', $user->id)
                    ->where('patient_id', $request->patient_id)
                    ->with('patient')
                    ->latest()
                    ->get();
            } else {
                $records = MedicalRecord::where('doctor_id', $user->id)
                    ->with('patient')
                    ->latest()
                    ->get();
            }
        } else {
            $records = MedicalRecord::where('patient_id', $user->id)
                ->with('doctor')
                ->latest()
                ->get();
        }

        return view('medical-records.index', compact('records'));
    }

    public function create()
    {
        $patients = User::where('role', 'user')->get();
        return view('medical-records.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'diagnosis' => 'required|string',
            'recommendation' => 'required|string',
            'record_date' => 'required|date'
        ]);

        MedicalRecord::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => Auth::id(),
            'diagnosis' => $request->diagnosis,
            'recommendation' => $request->recommendation,
            'record_date' => $request->record_date
        ]);

        return redirect()->route('medical-records.index')
            ->with('success', 'Rekam medis berhasil ditambahkan');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        return view('medical-records.show', compact('medicalRecord'));
    }

    public function selectPatient()
    {
        $patients = User::where('role', 'user')->get();
        return view('medical-records.select-patient', compact('patients'));
    }
} 