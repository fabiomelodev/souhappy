<?php

namespace App\Filament\Resources\Petitions\Pages;

use App\Filament\Resources\Petitions\PetitionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPetition extends EditRecord
{
    protected static string $resource = PetitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PetitionResource::exportPdfAction(),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
