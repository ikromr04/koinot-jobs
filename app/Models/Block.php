<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Block extends Model
{
    protected $guarded = [];

    public function translations(): HasMany
    {
        return $this->hasMany(BlockTranslation::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(BlockTranslation::class)
            ->where('locale', app()->getLocale());
    }
}
