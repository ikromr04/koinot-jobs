<?php

namespace App\Filament\Resources\Faqs\Pages;

use App\Filament\Resources\Faqs\FaqResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditFaq extends EditRecord
{
    protected static string $resource = FaqResource::class;

    protected static ?string $title = 'Редактирование';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Удалить?')
                ->modalDescription('Это действие нельзя отменить'),
        ];
    }

    protected function handleRecordUpdate(Model $faq, array $data): Model
    {
        $ru = $faq->translations()->firstOrNew(['locale' => 'ru']);
        $en = $faq->translations()->firstOrNew(['locale' => 'en']);

        if (array_key_exists('question_ru', $data) && $data['question_ru'] !== $ru->question) {
            $ru->question = $data['question_ru'];
        }
        if (array_key_exists('answer_ru', $data) && $data['answer_ru'] !== $ru->answer) {
            $ru->answer = $data['answer_ru'];
        }

        if (array_key_exists('question_en', $data) && $data['question_en'] !== $en->question) {
            $en->question = $data['question_en'];
        }
        if (array_key_exists('answer_en', $data) && $data['answer_en'] !== $en->answer) {
            $en->answer = $data['answer_en'];
        }

        $ru->save();
        $en->save();
        $faq->save();

        return $faq;
    }
}
