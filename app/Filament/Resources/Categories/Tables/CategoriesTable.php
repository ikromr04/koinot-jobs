<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->leftJoin('category_translations as ru', function ($join) {
                        $join->on('ru.category_id', '=', 'categories.id')
                            ->where('ru.locale', 'ru');
                    })
                    ->leftJoin('category_translations as en', function ($join) {
                        $join->on('en.category_id', '=', 'categories.id')
                            ->where('en.locale', 'en');
                    })
                    ->select([
                        'categories.*',
                        'ru.name as name_ru',
                        'en.name as name_en',
                    ]);
            })
            ->columns([
                TextColumn::make('icon')
                    ->label('Иконка')
                    ->formatStateUsing(fn(?string $state) => $state ? new HtmlString($state) : null),

                TextColumn::make('name_ru')
                    ->label('Название (RU)')
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('ru.name', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),

                TextColumn::make('name_en')
                    ->label('Название (EN)')
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('en.name', 'like', "%{$search}%");
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
                    ->modalHeading('Удалить категорию?')
                    ->modalDescription('Это действие нельзя отменить'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
