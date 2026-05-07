<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    protected $guarded = [];

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(CompanyTranslation::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(CompanyTranslation::class)
            ->where('locale', app()->getLocale());
    }

    protected static function booted()
    {
        static::deleting(function ($company) {

            $company->load('translations');

            foreach ($company->translations as $translation) {

                if ($translation->logo && Storage::disk('public')->exists($translation->logo)) {
                    Storage::disk('public')->delete($translation->logo);
                }
            }
        });
    }
}
