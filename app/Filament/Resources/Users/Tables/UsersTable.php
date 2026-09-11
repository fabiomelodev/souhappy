<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Papel')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => $state === 'council_member' ? 'Conselheiro' : 'Morador')
                    ->color(fn (string $state) => $state === 'council_member' ? 'warning' : 'gray'),

                TextColumn::make('tower')
                    ->label('Torre'),

                TextColumn::make('apartment_number')
                    ->label('Apartamento'),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Papel')
                    ->options([
                        'resident' => 'Morador',
                        'council_member' => 'Conselheiro',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
