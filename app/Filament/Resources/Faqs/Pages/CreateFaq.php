<?php

namespace App\Filament\Resources\Faqs\Pages;

use App\Filament\Resources\Faqs\FaqResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateFaq extends CreateRecord
{
    protected static string $resource = FaqResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $faq = static::getModel()::create();

        $faq->translations()->create([
            'locale' => 'ru',
            'question' => $data['question_ru'],
            'answer' => $data['answer_ru'],
        ]);

        $faq->translations()->create([
            'locale' => 'en',
            'question' => $data['question_en'],
            'answer' => $data['answer_en'],
        ]);

        return $faq;
    }
}
