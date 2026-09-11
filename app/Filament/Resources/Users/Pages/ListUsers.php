<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('inviteLink')
                ->label('Link de cadastro')
                ->icon(Heroicon::OutlinedLink)
                ->color('gray')
                ->modalHeading('Link de cadastro dos moradores')
                ->modalDescription('Compartilhe este link com os moradores para que eles criem a própria conta já vinculada a este condomínio.')
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Fechar')
                ->schema([
                    TextInput::make('link')
                        ->label('Link de cadastro')
                        ->default(fn () => route('resident.register', ['condominium' => Filament::getTenant()]))
                        ->readOnly()
                        ->copyable(copyMessage: 'Link copiado!', copyMessageDuration: 1500),
                ]),

            CreateAction::make(),
        ];
    }
}
