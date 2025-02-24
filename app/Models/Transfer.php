<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'amount',
        'date',
        'from_account_id',
        'to_account_id', 'amount'
    ];

    public function fromAccount()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function toAccount()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }


    // Accessing the accounts from a transfer
//$transfer = Transfer::find(1);
//$fromAccount = $transfer->fromAccount;
//$toAccount = $transfer->toAccount;

// Accessing transfers from an account
//$account = Account::find(1);
//$transfersFrom = $account->transfersFrom;
//$transfersTo = $account->transfersTo;
}
