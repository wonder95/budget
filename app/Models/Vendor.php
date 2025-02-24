<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vendor extends Model
{
    protected $fillable = [
        'name'
    ];

    public function paycheck(): BelongsTo
    {
        return $this->belongsTo(Paycheck::class);
    }
    public function transaction(): HasOne
    {
        return $this->hasOne(Paycheck::class);
    }
}
