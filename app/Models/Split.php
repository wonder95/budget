<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Split extends Model
{
    protected $fillable = ['amount'];

    public function splittable()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->morphTo();
    }
}
