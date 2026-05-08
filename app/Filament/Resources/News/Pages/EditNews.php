<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected static ?string $title = 'Редактировать новость';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Удалить новость?')
                ->modalDescription('Это действие нельзя отменить')
        ];
    }

    protected function handleRecordUpdate(Model $news, array $data): Model
    {
        $ru = $news->translations()->firstOrNew(['locale' => 'ru']);
        $en = $news->translations()->firstOrNew(['locale' => 'en']);

        if (array_key_exists('date', $data) && $data['date'] !== $news->date) {
            $news->date = $data['date'];
        }

        if (array_key_exists('title_ru', $data) && $data['title_ru'] !== $ru->title) {
            $ru->title = $data['title_ru'];
        }
        if (array_key_exists('content_ru', $data) && $data['content_ru'] !== $ru->content) {
            $ru->content = $data['content_ru'];
        }
        if (array_key_exists('image_ru', $data) && $data['image_ru'] !== $ru->image) {
            if ($ru->image && Storage::disk('public')->exists($ru->image)) {
                Storage::disk('public')->delete($ru->image);
            }

            $ru->image = $data['image_ru'];
        }

        if (array_key_exists('title_en', $data) && $data['title_en'] !== $en->title) {
            $en->title = $data['title_en'];
        }
        if (array_key_exists('content_en', $data) && $data['content_en'] !== $en->content) {
            $en->content = $data['content_en'];
        }
        if (array_key_exists('image_en', $data) && $data['image_en'] !== $en->image) {
            if ($en->image && Storage::disk('public')->exists($en->image)) {
                Storage::disk('public')->delete($en->image);
            }

            $en->image = $data['image_en'];
        }

        $ru->save();
        $en->save();
        $news->save();

        return $news;
    }
}
