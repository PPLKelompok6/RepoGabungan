<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EPrescription extends Model
{
    protected $fillable = [
        'appointment_id',
        'doctor_id',
        'patient_id',
        'medication_details',
        'instructions',
        'notes',
        'status',
        'valid_until'
    ];

    protected $casts = [
        'valid_until' => 'datetime'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
