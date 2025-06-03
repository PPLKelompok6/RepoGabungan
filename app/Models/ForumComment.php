<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'forum_post_id',
        'comment',
        'parent_id'
    ];

    // Relasi dengan user (pembuat komentar)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan post yang dikomentari
    public function post(): BelongsTo
    {
        return $this->belongsTo(ForumPost::class, 'forum_post_id');
    }

    // Relasi dengan parent comment (untuk fitur reply)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ForumComment::class, 'parent_id');
    }

    // Relasi dengan child comments (balasan komentar)
    public function replies(): HasMany
    {
        return $this->hasMany(ForumComment::class, 'parent_id');
    }
}