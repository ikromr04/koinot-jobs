<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->leftJoin('news_translations as ru', function ($join) {
                        $join->on('ru.news_id', '=', 'news.id')
                            ->where('ru.locale', 'ru');
                    })
                    ->leftJoin('news_translations as en', function ($join) {
                        $join->on('en.news_id', '=', 'news.id')
                            ->where('en.locale', 'en');
                    })
                    ->select([
                        'news.*',
                        'ru.title as title_ru',
                        'ru.content as content_ru',
                        'ru.image as image_ru',
                        'en.title as title_en',
                        'en.content as content_en',
                        'en.image as image_en',
                    ]);
            })
            ->columns([
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

                TextColumn::make('date')
                    ->label('Дата')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->modalHeading('Удалить новость?')
                    ->modalDescription('Это действие нельзя отменить')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
