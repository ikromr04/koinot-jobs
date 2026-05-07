<?php

namespace App\Filament\Resources\Vacancies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VacanciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->leftJoin('vacancy_translations as ru', function ($join) {
                        $join->on('ru.vacancy_id', '=', 'vacancies.id')
                            ->where('ru.locale', 'ru');
                    })
                    ->leftJoin('vacancy_translations as en', function ($join) {
                        $join->on('en.vacancy_id', '=', 'vacancies.id')
                            ->where('en.locale', 'en');
                    })
                    ->select([
                        'vacancies.*',
                        'ru.title as title_ru',
                        'ru.content as content_ru',
                        'ru.city as city_ru',
                        'en.title as title_en',
                        'en.content as content_en',
                        'en.city as city_en',
                    ])
                    ->with(['company.translation', 'category.translation']);
            })
            ->columns([
                TextColumn::make('company.translation.name')
                    ->label('Компания')
                    ->sortable(),

                TextColumn::make('category.translation.name')
                    ->label('Категория')
                    ->sortable(),

                TextColumn::make('title_ru')
                    ->label('Заголовок (RU)')
                    ->state(fn($record) => strip_tags($record->title_ru))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('ru.title', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),

                TextColumn::make('title_en')
                    ->label('Заголовок (EN)')
                    ->state(fn($record) => strip_tags($record->title_en))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('en.title', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),

                CheckboxColumn::make('hot')
                    ->label('Горячая вакансия'),

                TextColumn::make('city_ru')
                    ->label('Город (RU)')
                    ->state(fn($record) => strip_tags($record->city_ru))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('ru.city', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),

                TextColumn::make('city_en')
                    ->label('Город (EN)')
                    ->state(fn($record) => strip_tags($record->city_en))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('en.city', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->modalHeading('Удалить вакансию?')
                    ->modalDescription('Это действие нельзя отменить')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
