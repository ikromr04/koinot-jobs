<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::prefix(parseLocale())->group(function () {
  Route::get('/', [PageController::class, 'index'])->name('pages.index');
  Route::get('/team', [PageController::class, 'team'])->name('pages.team');
  Route::get('/news', [PageController::class, 'news'])->name('pages.news');
  Route::get('/resume', [PageController::class, 'resume'])->name('pages.resume');
  Route::get('/vacancies', [PageController::class, 'vacancies'])->name('pages.vacancies');
  Route::get('/vacancies/{vacancy}', [PageController::class, 'vacancy'])->name('pages.vacancy');
  Route::get('/categories/{category}', [PageController::class, 'category'])->name('pages.category');
  Route::get('/teambuilding', [PageController::class, 'teambuilding'])->name('pages.teambuilding');
  Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');

  Route::post('/vacancies/send-resume', [VacancyController::class, 'sendResume'])->name('vacancies.send-resume');
});

function parseLocale()
{
  $locale = request()->segment(1);
  $availableLocales = config('app.available_locales');
  $defaultLocale = config('app.fallback_locale');

  if ($locale !== $defaultLocale && in_array($locale, $availableLocales)) {
    app()->setLocale($locale);

    return $locale;
  }

  app()->setLocale($defaultLocale);

  return '';
}
