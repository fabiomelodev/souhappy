<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register;

class RegisterCouncilMember extends Register
{
    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['role'] = 'council_member';

        return $data;
    }
}
