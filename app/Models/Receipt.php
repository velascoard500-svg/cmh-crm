<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receipt extends Model
{
    protected $fillable = [
        'quote_id','folio','payment_date','amount','payment_method','reference','notes',
    ];

    protected function casts(): array
    {
        return ['payment_date' => 'date', 'amount' => 'decimal:2'];
    }

    public function quote(): BelongsTo { return $this->belongsTo(Quote::class); }

    protected static function booted(): void
    {
        static::created(function (Receipt $receipt): void {
            if (! $receipt->folio) {
                $sequence = $receipt->quote->receipts()->where('id', '<=', $receipt->id)->count();
                $quoteNumber = str_pad((string) $receipt->quote_id, 6, '0', STR_PAD_LEFT);
                $receipt->forceFill([
                    'folio' => 'REC-' . $quoteNumber . '-' . str_pad((string) $sequence, 2, '0', STR_PAD_LEFT),
                ])->saveQuietly();
            }
        });
    }
}