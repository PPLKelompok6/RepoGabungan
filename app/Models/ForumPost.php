<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category',
        'status',
        'views_count',
        'last_activity_at'
    ];

    protected $casts = [
        'last_activity_at' => 'datetime'
    ];

    // Relasi dengan user (pembuat post)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan komentar
    public function comments(): HasMany
    {
        return $this->hasMany(ForumComment::class)->orderBy('created_at', 'asc');
    }

    // Scope untuk mendapatkan post terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('last_activity_at', 'desc');
    }

    // Scope untuk mencari berdasarkan kata kunci
    public function scopeSearch($query, $keyword)
    {
        return $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%");
    }

    // Method untuk menambah jumlah view
    public function incrementViewsCount()
    {
        $this->increment('views_count');
    }

    // Method untuk update last activity
    public function updateLastActivity()
    {
        $this->update(['last_activity_at' => now()]);
    }
}