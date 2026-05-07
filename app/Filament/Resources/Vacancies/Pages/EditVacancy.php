<?php

namespace App\Filament\Resources\Vacancies\Pages;

use App\Filament\Resources\Vacancies\VacancyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditVacancy extends EditRecord
{
    protected static string $resource = VacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Удалить вакансию?')
                ->modalDescription('Это действие нельзя отменить')
        ];
    }

    protected function handleRecordUpdate(Model $vacancy, array $data): Model
    {
        $ru = $vacancy->translations()->firstOrNew(['locale' => 'ru']);
        $en = $vacancy->translations()->firstOrNew(['locale' => 'en']);

        if (array_key_exists('company_id', $data) && $data['company_id'] !== $vacancy->company_id) {
            $vacancy->company_id = $data['company_id'];
        }
        if (array_key_exists('category_id', $data) && $data['category_id'] !== $vacancy->category_id) {
            $vacancy->category_id = $data['category_id'];
        }
        if (array_key_exists('hot', $data) && $data['hot'] !== $vacancy->hot) {
            $vacancy->hot = $data['hot'];
        }

        if (array_key_exists('title_ru', $data) && $data['title_ru'] !== $ru->title) {
            $ru->title = $data['title_ru'];
        }
        if (array_key_exists('content_ru', $data) && $data['content_ru'] !== $ru->content) {
            $ru->content = $data['content_ru'];
        }
        if (array_key_exists('city_ru', $data) && $data['city_ru'] !== $ru->city) {
            $ru->city = $data['city_ru'];
        }

        if (array_key_exists('title_en', $data) && $data['title_en'] !== $en->title) {
            $en->title = $data['title_en'];
        }
        if (array_key_exists('content_en', $data) && $data['content_en'] !== $en->content) {
            $en->content = $data['content_en'];
        }
        if (array_key_exists('city_en', $data) && $data['city_en'] !== $en->city) {
            $en->city = $data['city_en'];
        }

        $ru->save();
        $en->save();
        $vacancy->save();

        return $vacancy;
    }
}
