<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->components([
                        TextEntry::make('name')->label('Nome'),
                        TextEntry::make('email')->label('E-mail'),
                        TextEntry::make('role')
                            ->label('Papel')
                            ->formatStateUsing(fn (string $state) => $state === 'council_member' ? 'Conselheiro' : 'Morador'),
                        TextEntry::make('tower')->label('Torre'),
                        TextEntry::make('apartment_number')->label('Apartamento'),
                        TextEntry::make('created_at')->label('Criado em')->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}
