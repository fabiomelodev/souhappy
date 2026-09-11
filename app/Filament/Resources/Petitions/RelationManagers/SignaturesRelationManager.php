<?php

namespace App\Filament\Resources\Petitions\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SignaturesRelationManager extends RelationManager
{
    protected static string $relationship = 'signatures';

    protected static ?string $title = 'Assinaturas';

    protected static ?string $modelLabel = 'assinatura';

    protected static ?string $pluralModelLabel = 'assinaturas';

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                TextColumn::make('full_name')
                    ->label('Nome completo')
                    ->searchable(),

                TextColumn::make('tower')
                    ->label('Torre'),

                TextColumn::make('apartment_number')
                    ->label('Apartamento'),

                ImageColumn::make('signature_path')
                    ->label('Assinatura')
                    ->disk('public'),

                TextColumn::make('signed_at')
                    ->label('Assinado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('ip_address')
                    ->label('IP')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([])
            ->recordActions([
                DeleteAction::make()
                    ->label('Remover')
                    ->modalHeading('Remover assinatura')
                    ->modalDescription('Tem certeza que deseja remover esta assinatura? Essa ação não pode ser desfeita.'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('signed_at', 'desc');
    }
}
