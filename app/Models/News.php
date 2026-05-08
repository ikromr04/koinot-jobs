<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $guarded = [];

    public function translations(): HasMany
    {
        return $this->hasMany(NewsTranslation::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(NewsTranslation::class)
            ->where('locale', app()->getLocale());
    }

    protected static function booted()
    {
        static::deleting(function ($company) {

            $company->load('translations');

            foreach ($company->translations as $translation) {

                if ($translation->image && Storage::disk('public')->exists($translation->image)) {
                    Storage::disk('public')->delete($translation->image);
                }
            }
        });
    }
}
