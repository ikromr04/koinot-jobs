<?php

namespace App\Filament\Resources\Vacancies\Schemas;

use App\Models\Category;
use App\Models\Company;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VacancyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->label('Компания')
                    ->options(
                        Company::query()
                            ->join('company_translations', 'companies.id', '=', 'company_translations.company_id')
                            ->where('company_translations.locale', 'ru')
                            ->pluck('company_translations.name', 'companies.id')
                    )
                    ->searchable()
                    ->preload(),

                Select::make('category_id')
                    ->label('Категория')
                    ->options(
                        Category::query()
                            ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
                            ->where('category_translations.locale', 'ru')
                            ->pluck('category_translations.name', 'categories.id')
                    )
                    ->searchable()
                    ->preload(),

                RichEditor::make('title_ru')
                    ->label('Заголовок (RU)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->title);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),

                RichEditor::make('title_en')
                    ->label('Заголовок (EN)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->title);
                        }
                    })
                    ->toolbarButtons(config('filament.rich_editor_toolbar'))
                    ->textColors([])
                    ->customTextColors()
                    ->required(),

                TextInput::make('city_ru')
                    ->label('Город (RU)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->city);
                        }
                    })
                    ->required(),

                TextInput::make('city_en')
                    ->label('Город (EN)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->city);
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

                Checkbox::make('hot')
                    ->label('Горячая вакансия'),
            ]);
    }
}
