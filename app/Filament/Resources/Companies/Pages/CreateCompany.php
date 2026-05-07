<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected static ?string $title = 'Создать компанию';

    protected function handleRecordCreation(array $data): Model
    {
        $company = static::getModel()::create();

        if (isset($data['name_ru'])) {
            $company->translations()->create([
                'locale' => 'ru',
                'logo' => $data['logo_ru'],
                'name' => $data['name_ru'],
            ]);
        }

        if (isset($data['name_en'])) {
            $company->translations()->create([
                'locale' => 'en',
                'logo' => $data['logo_en'],
                'name' => $data['name_en'],
            ]);
        }

        return $company;
    }
}
