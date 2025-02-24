<?php

namespace App\Relationships;

use App\Models\Split;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphManyManySplitsCategoryTrait
{
    public function splits(): MorphMany
    {
        return $this->morphMany(Split::class, 'category');
    }
}
