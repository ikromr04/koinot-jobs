<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected static ?string $title = 'Создать категорию';

    protected function handleRecordCreation(array $data): Model
    {
        $category = static::getModel()::create([
            'icon' => $data['icon'] ?? null,
        ]);

        if (isset($data['ru_name'])) {
            $category->translations()->create([
                'locale' => 'ru',
                'name' => $data['ru_name'],
            ]);
        }

        if (isset($data['en_name'])) {
            $category->translations()->create([
                'locale' => 'en',
                'name' => $data['en_name'],
            ]);
        }

        return $category;
    }
}
