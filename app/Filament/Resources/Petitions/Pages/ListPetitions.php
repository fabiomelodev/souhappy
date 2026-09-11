<?php

namespace App\Filament\Resources\Petitions\Pages;

use App\Filament\Resources\Petitions\PetitionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPetitions extends ListRecords
{
    protected static string $resource = PetitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
