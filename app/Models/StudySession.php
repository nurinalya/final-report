<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudySession extends Model
{
    protected $fillable = [
        'user_id',
        'course_code',
        'topic',
        'type',
        'location',
        'session_date',
        'session_time',
        'max_slots',
        'available_slots',
        'joined_count',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'max_slots' => 'integer',
            'available_slots' => 'integer',
            'joined_count' => 'integer',
            'session_date' => 'date:Y-m-d',
            'session_time' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
