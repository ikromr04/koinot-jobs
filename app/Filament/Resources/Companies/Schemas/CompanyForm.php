<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo_ru')
                    ->label('Логотип (RU)')
                    ->image()
                    ->disk('public')
                    ->directory('images/companies')
                    ->visibility('public')
                    ->imageEditor()
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->logo);
                        }
                    })
                    ->required(),

                FileUpload::make('logo_en')
                    ->label('Логотип (EN)')
                    ->image()
                    ->disk('public')
                    ->directory('images/companies')
                    ->visibility('public')
                    ->imageEditor()
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->logo);
                        }
                    })
                    ->required(),

                TextInput::make('name_ru')
                    ->label('Название (RU)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'ru');

                        if ($translation) {
                            $component->state($translation->name);
                        }
                    })
                    ->required()
                    ->maxLength(25),

                TextInput::make('name_en')
                    ->label('Название (EN)')
                    ->afterStateHydrated(function ($component, $record) {
                        if (!$record) return;

                        $translation = $record->translations->firstWhere('locale', 'en');

                        if ($translation) {
                            $component->state($translation->name);
                        }
                    })
                    ->required()
                    ->maxLength(25),
            ]);
    }
}
