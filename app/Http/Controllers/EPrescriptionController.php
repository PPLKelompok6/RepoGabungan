<?php

namespace App\Http\Controllers;

use App\Models\EPrescription;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;

class EPrescriptionController extends Controller
{
    public function create(Appointment $appointment)
    {
        if (Auth::user()->role !== 'doctor') {
            abort(403, 'Unauthorized action.');
        }

        return view('e_prescriptions.create', compact('appointment'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        if (Auth::user()->role !== 'doctor') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'medication_details' => 'required|string',
            'instructions' => 'nullable|string',
            'notes' => 'nullable|string',
            'valid_until' => 'nullable|date|after:today'
        ]);

        $prescription = EPrescription::create([
            'appointment_id' => $appointment->id,
            'doctor_id' => Auth::id(),
            'patient_id' => $appointment->patient_id,
            'medication_details' => $validated['medication_details'],
            'instructions' => $validated['instructions'],
            'notes' => $validated['notes'],
            'valid_until' => $validated['valid_until'] ?? Carbon::now()->addDays(7),
            'status' => 'active'
        ]);

        return redirect()->route('doctor.appointments.history')
            ->with('success', 'Resep digital berhasil dibuat.');
    }

    public function show(EPrescription $prescription)
    {
        if (Auth::id() !== $prescription->patient_id && 
            Auth::id() !== $prescription->doctor_id && 
            !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('e_prescriptions.show', compact('prescription'));
    }

    public function download(EPrescription $prescription)
    {
        if (Auth::id() !== $prescription->patient_id && 
            Auth::id() !== $prescription->doctor_id && 
            !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $pdf = PDF::loadView('e_prescriptions.pdf', compact('prescription'));
        
        return $pdf->download('resep-' . $prescription->id . '.pdf');
    }

    public function updateStatus(EPrescription $prescription)
    {
        if (auth()->id() !== $prescription->patient_id) {
            abort(403, 'Unauthorized action.');
        }

        $prescription->update([
            'status' => 'completed'
        ]);

        return redirect()->back()->with('success', 'Status resep berhasil diperbarui.');
    }

    public function patientHistory(Request $request)
    {
        $sort = $request->query('sort', 'desc'); // default sort by newest
        
        $prescriptions = EPrescription::with(['appointment', 'appointment.doctor'])
            ->whereHas('appointment', function($query) {
                $query->where('patient_id', auth()->id());
            })
            ->orderBy('created_at', $sort)
            ->get();

        return view('e-prescriptions.patient-history', compact('prescriptions', 'sort'));
    }
}
