<?php

namespace App\Filament\Resources\Petitions\Tables;

use App\Filament\Resources\Petitions\PetitionResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PetitionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->weight('medium'),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => $state === 'pdf' ? 'PDF' : 'Texto')
                    ->color(fn (string $state) => $state === 'pdf' ? 'info' : 'gray'),

                TextColumn::make('status')
                    ->label('Situação')
                    ->badge()
                    ->state(fn ($record) => $record->effectiveStatusLabel())
                    ->color(fn ($record) => $record->effectiveStatusColor()),

                TextColumn::make('signatures_count')
                    ->label('Assinaturas')
                    ->counts('signatures')
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label('Publicação')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Imediata')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deadline_at')
                    ->label('Prazo final')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Sem prazo')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('creator.name')
                    ->label('Criado por'),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Situação')
                    ->options([
                        'open' => 'Aberto',
                        'closed' => 'Encerrado',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                PetitionResource::exportPdfAction(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
