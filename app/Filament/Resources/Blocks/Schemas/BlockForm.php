<?php

namespace App\Filament\Resources\Blocks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BlockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_ru')
                    ->label('Картинка (RU)')
                    ->image()
                    ->disk('public')
                    ->directory('images/blocks')
                    ->visibility('public')
                    ->imageEditor()
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->logo);
                        }
                    }),

                FileUpload::make('image_en')
                    ->label('Картинка (EN)')
                    ->image()
                    ->disk('public')
                    ->directory('images/blocks')
                    ->visibility('public')
                    ->imageEditor()
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->logo);
                        }
                    }),

                TextInput::make('title_ru')
                    ->label('Заголовок (RU)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations
                            ->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->title);
                        }
                    })
                    ->required(),

                TextInput::make('title_en')
                    ->label('Заголовок (EN)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations
                            ->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->title);
                        }
                    })
                    ->required(),

                RichEditor::make('content_ru')
                    ->label('Содержание (RU)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->content);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),

                RichEditor::make('content_en')
                    ->label('Содержание (EN)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->content);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),
            ]);
    }
}
