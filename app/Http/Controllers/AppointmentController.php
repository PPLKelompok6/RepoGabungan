<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorSchedule;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $appointments = Appointment::with(['patient', 'doctor'])->latest()->paginate(10);
        } elseif (Auth::user()->role === 'doctor') {
            $appointments = Auth::user()->appointments()->with('patient')->latest()->paginate(10);
        } else {
            $appointments = Auth::user()->appointments()->with('doctor')->latest()->paginate(10);
        }

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = User::where('role', 'doctor')
            ->with(['doctorSchedules' => function($query) {
                $query->orderBy('day', 'asc')
                      ->orderBy('start_time', 'asc');
            }])
            ->get();
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
            'notes' => 'nullable|string'
        ], [
            'appointment_date.after' => 'Waktu janji temu harus setelah waktu sekarang',
            'doctor_id.required' => 'Silakan pilih dokter terlebih dahulu',
            'doctor_id.exists' => 'Dokter yang dipilih tidak valid'
        ]);

        $appointmentDateTime = Carbon::parse($validated['appointment_date']);
        $dayOfWeek = strtolower($appointmentDateTime->format('l'));
        $time = $appointmentDateTime->format('H:i:s');

        // Inisialisasi model DoctorSchedule untuk translasi hari
        $doctorScheduleModel = new DoctorSchedule();
        $dayOfWeek = $doctorScheduleModel->translateDay($dayOfWeek);

        // Validasi jadwal dokter
        $doctorSchedule = DoctorSchedule::where('doctor_id', $validated['doctor_id'])
            ->where('day', $dayOfWeek)
            ->where('start_time', '<=', $time)
            ->where('end_time', '>', $time)
            ->first();

        if (!$doctorSchedule) {
            $dayNames = [
                'sunday' => 'Minggu',
                'monday' => 'Senin',
                'tuesday' => 'Selasa',
                'wednesday' => 'Rabu',
                'thursday' => 'Kamis',
                'friday' => 'Jumat',
                'saturday' => 'Sabtu'
            ];
            
            // Cari jadwal dokter untuk hari tersebut untuk memberikan informasi yang lebih baik
            $availableSchedule = DoctorSchedule::where('doctor_id', $validated['doctor_id'])
                ->where('day', $dayOfWeek)
                ->first();

            $errorMessage = sprintf(
                'Jadwal tidak tersedia pada %s pukul %s.',
                $dayNames[strtolower($doctorScheduleModel->translateDay($dayOfWeek))] ?? $dayOfWeek,
                $appointmentDateTime->format('H:i')
            );

            if ($availableSchedule) {
                $errorMessage .= sprintf(
                    ' Silakan pilih waktu antara %s sampai %s (sebelum jam selesai).',
                    Carbon::parse($availableSchedule->start_time)->format('H:i'),
                    Carbon::parse($availableSchedule->end_time)->format('H:i')
                );
            } else {
                $errorMessage .= ' Dokter tidak memiliki jadwal praktik di hari ini.';
            }
            
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_date' => $errorMessage
                ]);
        }

        // Cek apakah sudah ada appointment di waktu yang sama
        $existingAppointment = Appointment::where('doctor_id', $validated['doctor_id'])
            ->whereDate('appointment_date', $appointmentDateTime->toDateString())
            ->whereTime('appointment_date', $time)
            ->exists();

        if ($existingAppointment) {
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_date' => 'Jadwal sudah dibooking oleh pasien lain. Silakan pilih waktu lain.'
                ]);
        }

        $appointment = Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $validated['doctor_id'],
            'appointment_date' => $validated['appointment_date'],
            'notes' => $validated['notes'],
            'status' => 'pending'
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Janji temu berhasil dibuat. Silakan tunggu konfirmasi dari dokter.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function updateStatus(Appointment $appointment, Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment->update([
            'status' => $validatedData['status']
        ]);

        return redirect()->back()->with('success', 'Status janji temu berhasil diperbarui');
    }

    private function notifyPatient(Appointment $appointment)
    {
        // Menggunakan struktur tabel yang sesuai
        $appointment->patient->notifications()->create([
            'user_id' => $appointment->patient_id,
            'type' => 'appointment_confirmation',
            'message' => "Dokter telah siap untuk konsultasi pada " . 
                        $appointment->appointment_date->format('d M Y H:i'),
            'is_read' => false
        ]);
    }

    public function doctorHistory()
    {
        $appointments = Auth::user()
            ->doctorAppointments()
            ->with('patient')
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('doctor.appointments.history', compact('appointments'));
    }

    public function history()
    {
        $appointments = Auth::user()->patientAppointments()
            ->with('doctor')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);  // Menggunakan paginate() alih-alih get()
            
        return view('appointments.history', compact('appointments'));
    }
}