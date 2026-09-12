<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Dados pessoais')
                    ->description('Identificação do morador e a unidade em que mora.')
                    ->icon(Heroicon::OutlinedIdentification)
                    ->columnSpan(2)
                    ->components([
                        TextInput::make('name')
                            ->label('Nome completo')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('tower')
                            ->label('Torre')
                            ->maxLength(255),

                        TextInput::make('apartment_number')
                            ->label('Apartamento')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Acesso')
                    ->description('Papel no sistema e credenciais de login.')
                    ->icon(Heroicon::OutlinedLockClosed)
                    ->columnSpan(1)
                    ->components([
                        Select::make('role')
                            ->label('Papel')
                            ->options([
                                'resident' => 'Morador',
                                'council_member' => 'Conselheiro',
                            ])
                            ->default('resident')
                            ->required(),

                        TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn (string $state) => Hash::make($state))
                            ->dehydrated(fn (?string $state) => filled($state))
                            ->required(fn (string $operation) => $operation === 'create')
                            ->maxLength(255),
                    ]),
            ]);
    }
}
