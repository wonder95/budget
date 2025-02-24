<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\MorphManyManySplitsCategoryTrait;

class Withholding extends Model
{
    use MorphManyManySplitsCategoryTrait;

    protected $fillable = [
        'amount'
    ];
}
