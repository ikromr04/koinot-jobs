<?php

namespace App\Filament\Resources\Blocks\Pages;

use App\Filament\Resources\Blocks\BlockResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditBlock extends EditRecord
{
    protected static string $resource = BlockResource::class;

    protected static ?string $title = 'Редактировать блок';

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function handleRecordUpdate(Model $block, array $data): Model
    {
        $ru = $block->translations()->firstOrNew(['locale' => 'ru']);
        $en = $block->translations()->firstOrNew(['locale' => 'en']);

        if (array_key_exists('image_ru', $data) && $data['image_ru'] !== $ru->image) {
            if ($ru->image && Storage::disk('public')->exists($ru->image)) {
                Storage::disk('public')->delete($ru->image);
            }

            $ru->image = $data['image_ru'];
        }

        if (array_key_exists('title_ru', $data) && $data['title_ru'] !== $ru->title) {
            $ru->title = $data['title_ru'];
        }

        if (array_key_exists('content_ru', $data) && $data['content_ru'] !== $ru->content) {
            $ru->content = $data['content_ru'];
        }

        if (array_key_exists('image_en', $data) && $data['image_en'] !== $en->image) {
            if ($en->image && Storage::disk('public')->exists($en->image)) {
                Storage::disk('public')->delete($en->image);
            }

            $en->image = $data['image_en'];
        }

        if (array_key_exists('title_en', $data) && $data['title_en'] !== $en->title) {
            $en->title = $data['title_en'];
        }

        if (array_key_exists('content_en', $data) && $data['content_en'] !== $en->content) {
            $en->content = $data['content_en'];
        }

        $ru->save();
        $en->save();

        return $block;
    }
}
