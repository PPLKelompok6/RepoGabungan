<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthAssessment extends Model
{
    protected $fillable = [
        'user_id',
        'test_type',
        'results'
    ];

    protected $casts = [
        'results' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}