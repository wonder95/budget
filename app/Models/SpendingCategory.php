<?php

namespace App\Models;

use App\Relationships\MorphManyManySplitsCategoryTrait;
use Illuminate\Database\Eloquent\Model;

class SpendingCategory extends Model
{
    use MorphManyManySplitsCategoryTrait;

    protected $fillable = [
        'name'
    ];
}
