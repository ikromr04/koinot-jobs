<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
