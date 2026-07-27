<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->leftJoin('faq_translations as ru', function ($join) {
                        $join->on('ru.faq_id', '=', 'faqs.id')
                            ->where('ru.locale', 'ru');
                    })
                    ->leftJoin('faq_translations as en', function ($join) {
                        $join->on('en.faq_id', '=', 'faqs.id')
                            ->where('en.locale', 'en');
                    })
                    ->select([
                        'faqs.*',
                        'ru.question as question_ru',
                        'ru.answer as answer_ru',
                        'en.question as question_en',
                        'en.answer as answer_en',
                    ]);
            })
            ->columns([
                TextColumn::make('question_ru')
                    ->label('Вопрос (RU)')
                    ->state(fn($record) => strip_tags($record->question_ru))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('ru.question', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),
                TextColumn::make('question_en')
                    ->label('Вопрос (EN)')
                    ->state(fn($record) => strip_tags($record->question_en))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('en.question', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),
                TextColumn::make('answer_ru')
                    ->label('Ответ (RU)')
                    ->state(fn($record) => strip_tags($record->answer_ru))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('ru.answer', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),
                TextColumn::make('answer_en')
                    ->label('Ответ (EN)')
                    ->state(fn($record) => strip_tags($record->answer_en))
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('en.answer', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
