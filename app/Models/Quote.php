<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
    protected $fillable = [
        'client_id','folio','quote_date','valid_until','status','delivery_time',
        'notes','subtotal','discount','total',
    ];

    protected function casts(): array
    {
        return [
            'quote_date' => 'date',
            'valid_until' => 'date',
            'subtotal' => 'decimal:2',
            'discount' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function client(): BelongsTo { return $this->belongsTo(Client::class); }
    public function items(): HasMany { return $this->hasMany(QuoteItem::class); }
    public function receipts(): HasMany { return $this->hasMany(Receipt::class); }

    public function getPaidAttribute(): string
    {
        return (string) $this->receipts()->sum('amount');
    }

    public function getBalanceAttribute(): string
    {
        return (string) max(0, (float) $this->total - (float) $this->receipts()->sum('amount'));
    }

    protected static function booted(): void
    {
        static::created(function (Quote $quote): void {
            if (! $quote->folio) {
                $quote->forceFill(['folio' => 'COT-' . str_pad((string) $quote->id, 6, '0', STR_PAD_LEFT)])->saveQuietly();
            }
        });
    }
}