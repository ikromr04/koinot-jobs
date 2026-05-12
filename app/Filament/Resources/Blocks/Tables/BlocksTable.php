<?php

namespace App\Filament\Resources\Blocks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BlocksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->leftJoin('block_translations as ru', function ($join) {
                        $join->on('ru.block_id', '=', 'blocks.id')
                            ->where('ru.locale', 'ru');
                    })
                    ->leftJoin('block_translations as en', function ($join) {
                        $join->on('en.block_id', '=', 'blocks.id')
                            ->where('en.locale', 'en');
                    })
                    ->select([
                        'blocks.*',
                        'ru.title as title_ru',
                        'en.title as title_en',
                    ]);
            })
            ->columns([
                TextColumn::make('title_ru')
                    ->label('Заголовок (RU)')
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('ru.title', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),

                TextColumn::make('title_en')
                    ->label('Заголовок (EN)')
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('en.title', 'like', "%{$search}%");
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
            ->toolbarActions([]);
    }
}
