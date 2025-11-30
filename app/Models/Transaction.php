<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\MorphManyManySplitsSplittableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Aliziodev\LaravelTaxonomy\Traits\HasTaxonomy;

class Transaction extends Model
{
    use MorphManyManySplitsSplittableTrait, HasTaxonomy;

    protected $fillable = [
        'amount',
        'date',
        'type',
        'description',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function payPeriod(): BelongsTo
    {
        return $this->belongsTo(PayPeriod::class);
    }
}
