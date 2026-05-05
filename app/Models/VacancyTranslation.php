<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VacancyTranslation extends Model
{
  protected $guarded = [];

  public function vacancy(): BelongsTo
  {
    return $this->belongsTo(Vacancy::class);
  }
}
