<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $fillable = ['doctor_id', 'day', 'start_time', 'end_time'];

    protected $dayMappings = [
        'sunday' => 'minggu',
        'monday' => 'senin',
        'tuesday' => 'selasa',
        'wednesday' => 'rabu',
        'thursday' => 'kamis',
        'friday' => 'jumat',
        'saturday' => 'sabtu',
        'minggu' => 'sunday',
        'senin' => 'monday',
        'selasa' => 'tuesday',
        'rabu' => 'wednesday',
        'kamis' => 'thursday',
        'jumat' => 'friday',
        'sabtu' => 'saturday'
    ];

    public function setDayAttribute($value)
    {
        $this->attributes['day'] = strtolower($value);
    }

    public function getDayAttribute($value)
    {
        return strtolower($value);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function translateDay($day)
    {
        $day = strtolower($day);
        return $this->dayMappings[$day] ?? $day;
    }
}