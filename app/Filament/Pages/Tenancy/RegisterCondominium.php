<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Condominium;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class RegisterCondominium extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Cadastrar condomínio';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome do condomínio')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $condominium = Condominium::create($data);

        Filament::auth()->user()->update([
            'condominium_id' => $condominium->id,
            'role' => 'council_member',
        ]);

        return $condominium;
    }
}
