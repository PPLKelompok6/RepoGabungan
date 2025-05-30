<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MentalHealthTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_type',
        'score',
        'usia',  // Sesuaikan dengan nama kolom di database
        'gender',
        'domisili',
        'pekerjaan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}