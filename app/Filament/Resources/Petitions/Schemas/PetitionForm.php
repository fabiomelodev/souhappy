<?php

namespace App\Filament\Resources\Petitions\Schemas;

use Carbon\Carbon;
use Closure;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PetitionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Conteúdo')
                    ->description('Título e conteúdo que os moradores vão ver ao abrir o abaixo-assinado.')
                    ->icon(Heroicon::OutlinedDocumentText)
                    ->columnSpan(2)
                    ->components([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        ToggleButtons::make('type')
                            ->label('Conteúdo do abaixo-assinado')
                            ->inline()
                            ->options([
                                'text' => 'Texto',
                                'pdf' => 'Arquivo PDF',
                            ])
                            ->default('text')
                            ->required()
                            ->live()
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->label('Texto do abaixo-assinado')
                            ->required(fn ($get) => $get('type') === 'text')
                            ->visible(fn ($get) => $get('type') === 'text')
                            ->columnSpanFull(),

                        FileUpload::make('pdf_path')
                            ->label('Arquivo PDF')
                            ->disk('public')
                            ->directory('petitions')
                            ->acceptedFileTypes(['application/pdf'])
                            ->openable()
                            ->required(fn ($get) => $get('type') === 'pdf')
                            ->visible(fn ($get) => $get('type') === 'pdf')
                            ->columnSpanFull(),
                    ]),

                Section::make('Publicação')
                    ->description('Situação atual e janela de tempo para assinaturas.')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->columnSpan(1)
                    ->components([
                        Select::make('status')
                            ->label('Situação')
                            ->options([
                                'open' => 'Aberto para assinaturas',
                                'closed' => 'Encerrado',
                            ])
                            ->default('open')
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->label('Data de publicação')
                            ->native(false)
                            ->seconds(false)
                            ->helperText('Em branco publica imediatamente.'),

                        DateTimePicker::make('deadline_at')
                            ->label('Prazo final')
                            ->native(false)
                            ->seconds(false)
                            ->helperText('Em branco não define prazo. Depois dessa data, encerra automaticamente.')
                            ->rule(static function (Get $get): Closure {
                                return function (string $attribute, $value, Closure $fail) use ($get): void {
                                    $publishedAt = $get('published_at');

                                    if (! $publishedAt || ! $value) {
                                        return;
                                    }

                                    if (Carbon::parse($value)->lessThanOrEqualTo(Carbon::parse($publishedAt))) {
                                        $fail('O prazo final deve ser depois da data de publicação.');
                                    }
                                };
                            }),
                    ]),
            ]);
    }
}
