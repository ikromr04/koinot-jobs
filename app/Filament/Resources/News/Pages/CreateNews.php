<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected static ?string $title = 'Создать новость';

    protected function handleRecordCreation(array $data): Model
    {
        $news = static::getModel()::create([
            'date' => $data['date'],
        ]);

        $news->translations()->create([
            'locale' => 'ru',
            'image' => $data['image_ru'],
            'title' => $data['title_ru'],
            'content' => $data['content_ru'],
        ]);

        $news->translations()->create([
            'locale' => 'en',
            'image' => $data['image_en'],
            'title' => $data['title_en'],
            'content' => $data['content_en'],
        ]);

        return $news;
    }
}
