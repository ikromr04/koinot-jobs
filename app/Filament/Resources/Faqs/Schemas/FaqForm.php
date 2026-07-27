<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('question_ru')
                    ->label('Вопрос (RU)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->question);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),

                RichEditor::make('question_en')
                    ->label('Вщпрос (EN)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->question);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),


                RichEditor::make('answer_ru')
                    ->label('Ответ (RU)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->answer);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),

                RichEditor::make('answer_en')
                    ->label('Ответ (EN)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->answer);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),
            ]);
    }
}
