<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayPeriod extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'starting_balance'
    ];

    public function paychecks(): HasMany
    {
        return $this->hasMany(Paycheck::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
