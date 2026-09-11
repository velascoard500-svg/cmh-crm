<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'phone',
        'email',
        'product',
        'stage',
        'estimated_amount',
        'source',
        'next_follow_up',
        'notes',
        'position',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'estimated_amount' => 'decimal:2',
            'next_follow_up' => 'date',
            'position' => 'integer',
            'active' => 'boolean',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
