<?php

namespace App\Filament\Resources\Petitions\Pages;

use App\Filament\Resources\Petitions\PetitionResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreatePetition extends CreateRecord
{
    protected static string $resource = PetitionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Filament::auth()->id();

        return $data;
    }
}
