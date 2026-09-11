<?php

namespace App\Filament\Resources\Petitions;

use App\Filament\Resources\Petitions\Pages\CreatePetition;
use App\Filament\Resources\Petitions\Pages\EditPetition;
use App\Filament\Resources\Petitions\Pages\ListPetitions;
use App\Filament\Resources\Petitions\Pages\ViewPetition;
use App\Filament\Resources\Petitions\Schemas\PetitionForm;
use App\Filament\Resources\Petitions\Schemas\PetitionInfolist;
use App\Filament\Resources\Petitions\RelationManagers\SignaturesRelationManager;
use App\Filament\Resources\Petitions\Tables\PetitionsTable;
use App\Models\Petition;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PetitionResource extends Resource
{
    protected static ?string $model = Petition::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Abaixo-assinado';

    protected static ?string $pluralModelLabel = 'Abaixo-assinados';

    protected static ?string $navigationLabel = 'Abaixo-assinados';

    protected static UnitEnum|string|null $navigationGroup = 'Ferramentas';

    public static function exportPdfAction(): Action
    {
        return Action::make('exportPdf')
            ->label('Exportar PDF')
            ->icon(Heroicon::OutlinedArrowDownTray)
            ->color('gray')
            ->url(fn (Petition $record) => route('petitions.export', $record))
            ->openUrlInNewTab();
    }

    public static function form(Schema $schema): Schema
    {
        return PetitionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PetitionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PetitionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SignaturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPetitions::route('/'),
            'create' => CreatePetition::route('/create'),
            'view' => ViewPetition::route('/{record}'),
            'edit' => EditPetition::route('/{record}/edit'),
        ];
    }
}
