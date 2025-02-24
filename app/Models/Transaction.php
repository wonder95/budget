<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\MorphManyManySplitsSplittableTrait;

class Transaction extends Model
{
    use MorphManyManySplitsSplittableTrait;

    protected $fillable = [
        'amount',
        'date',
        'type'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function trnsaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function budgetCategory()
    {
        return $this->belongsTo(BudgetCategory::class);
    }
}
