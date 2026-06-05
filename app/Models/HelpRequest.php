<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HelpRequest extends Model
{
    protected $fillable = [
        'user_id',
        'course_code',
        'topic',
        'description',
        'status',
        'response_count',
    ];

    protected function casts(): array
    {
        return [
            'response_count' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
