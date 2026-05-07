<?php

namespace App\Filament\Resources\Vacancies\Pages;

use App\Filament\Resources\Vacancies\VacancyResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateVacancy extends CreateRecord
{
    protected static string $resource = VacancyResource::class;

    protected static ?string $title = 'Создать вакансию';

    protected function handleRecordCreation(array $data): Model
    {
        $vacancy = static::getModel()::create([
            'company_id' => $data['company_id'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'hot' => $data['hot'] ?? false,
        ]);

        $vacancy->translations()->create([
            'locale' => 'ru',
            'title' => $data['title_ru'],
            'content' => $data['content_ru'],
            'city' => $data['city_ru'],
        ]);

        $vacancy->translations()->create([
            'locale' => 'en',
            'title' => $data['title_en'],
            'content' => $data['content_en'],
            'city' => $data['city_en'],
        ]);

        return $vacancy;
    }
}
