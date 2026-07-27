<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Faq extends Model
{
    protected $guarded = [];

    public function translations(): HasMany
    {
        return $this->hasMany(FaqTranslation::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(FaqTranslation::class)
            ->where('locale', app()->getLocale());
    }

}
