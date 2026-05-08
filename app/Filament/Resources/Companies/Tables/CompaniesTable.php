<?php

namespace App\Filament\Resources\Companies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->leftJoin('company_translations as ru', function ($join) {
                        $join->on('ru.company_id', '=', 'companies.id')
                            ->where('ru.locale', 'ru');
                    })
                    ->leftJoin('company_translations as en', function ($join) {
                        $join->on('en.company_id', '=', 'companies.id')
                            ->where('en.locale', 'en');
                    })
                    ->select([
                        'companies.*',
                        'ru.logo as logo_ru',
                        'ru.name as name_ru',
                        'en.logo as logo_en',
                        'en.name as name_en',
                    ]);
            })
            ->columns([
                ImageColumn::make('logo_ru')
                    ->label('Логотип (RU)')
                    ->imageHeight(40)
                    ->imageWidth(100)
                    ->getStateUsing(fn($record) => $record->logo_ru ? asset('/storage/'.$record->logo_ru) : null)
                    ->disk('public')
                    ->extraImgAttributes(['style' => 'object-fit: contain;']),

                TextColumn::make('name_ru')
                    ->label('Название (RU)')
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->where('ru.name', 'like', "%{$search}%");
                        }
                    )
                    ->sortable(),

                ImageColumn::make('logo_en')
                    ->label('Логотип (EN)')
                    ->imageHeight(40)
                    ->imageWidth(100)
                    ->getStateUsing(fn($record) => $record->logo_en ? asset('/storage/'.$record->logo_en) : null)
                    ->disk('public')
                    ->extraImgAttributes(['style' => 'object-fit: contain;']),

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
                    ->modalHeading('Удалить компанию?')
                    ->modalDescription('Это действие нельзя отменить')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
