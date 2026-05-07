<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected static ?string $title = 'Редактировать компанию';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Удалить компанию?')
                ->modalDescription('Это действие нельзя отменить')
        ];
    }

    protected function handleRecordUpdate(Model $company, array $data): Model
    {
        $ru = $company->translations()->firstOrNew(['locale' => 'ru']);
        $en = $company->translations()->firstOrNew(['locale' => 'en']);

        if (array_key_exists('logo_ru', $data) && $data['logo_ru'] !== $ru->logo) {
            if ($ru->logo && Storage::disk('public')->exists($ru->logo)) {
                Storage::disk('public')->delete($ru->logo);
            }

            $ru->logo = $data['logo_ru'];
        }

        if (array_key_exists('name_ru', $data) && $data['name_ru'] !== $ru->name) {
            $ru->name = $data['name_ru'];
        }

        if (array_key_exists('logo_en', $data) && $data['logo_en'] !== $en->logo) {
            if ($en->logo && Storage::disk('public')->exists($en->logo)) {
                Storage::disk('public')->delete($en->logo);
            }

            $en->logo = $data['logo_en'];
        }

        if (array_key_exists('name_en', $data) && $data['name_en'] !== $en->name) {
            $en->name = $data['name_en'];
        }

        $ru->locale = 'ru';
        $en->locale = 'en';

        $ru->save();
        $en->save();

        return $company;
    }
}
