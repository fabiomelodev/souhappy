<?php

namespace App\Filament\Resources\Petitions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PetitionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->components([
                        TextEntry::make('title')
                            ->label('Título')
                            ->columnSpanFull(),

                        TextEntry::make('status')
                            ->label('Situação')
                            ->badge()
                            ->state(fn ($record) => $record->effectiveStatusLabel())
                            ->color(fn ($record) => $record->effectiveStatusColor()),

                        TextEntry::make('signatures_count')
                            ->label('Assinaturas')
                            ->state(fn ($record) => $record->signatures()->count()),

                        TextEntry::make('creator.name')
                            ->label('Criado por'),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('published_at')
                            ->label('Data de publicação')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Publicado imediatamente'),

                        TextEntry::make('deadline_at')
                            ->label('Prazo final')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Sem prazo'),

                        TextEntry::make('content')
                            ->label('Texto')
                            ->html()
                            ->visible(fn ($record) => $record->type === 'text')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
