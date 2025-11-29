<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\MorphManyManySplitsSplittableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use MorphManyManySplitsSplittableTrait;

    protected $fillable = [
        'amount',
        'date',
        'type'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
    public function pay_period(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }
}
