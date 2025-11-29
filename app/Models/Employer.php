<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function paychecks()
    {
        return $this->hasMany(Paycheck::class);
    }
}
