<?php

namespace App\Filament\Resources\Petitions\Pages;

use App\Filament\Resources\Petitions\PetitionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPetition extends ViewRecord
{
    protected static string $resource = PetitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PetitionResource::exportPdfAction(),
            EditAction::make(),
        ];
    }
}
