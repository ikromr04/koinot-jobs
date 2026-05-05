<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vacancy extends Model
{
  protected $guarded = [];

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function translations(): HasMany
  {
    return $this->hasMany(VacancyTranslation::class);
  }

  public function translation(): HasOne
  {
    return $this->hasOne(VacancyTranslation::class)
      ->where('locale', app()->getLocale());
  }
}
