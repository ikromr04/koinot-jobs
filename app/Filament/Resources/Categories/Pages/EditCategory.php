<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected static ?string $title = 'Редактировать категорию';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Удалить категорию?')
                ->modalDescription('Это действие нельзя отменить')
        ];
    }

    protected function handleRecordUpdate(Model $category, array $data): Model
    {
        $category->update([
            'icon' => $data['icon'] ?? null,
        ]);

        if (isset($data['ru_name'])) {
            $category->translations()->updateOrCreate(
                ['locale' => 'ru'],
                ['name' => $data['ru_name']]
            );
        }

        if (isset($data['en_name'])) {
            $category->translations()->updateOrCreate(
                ['locale' => 'en'],
                ['name' => $data['en_name']]
            );
        }

        return $category;
    }
}
