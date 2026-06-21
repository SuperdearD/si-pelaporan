<?php

namespace App\Filament\Resources\IncidentFollowUps\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncidentFollowUpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(5)
                    ->schema([
                        Section::make('Aksi Korektif & Pengendalian')
                            ->columnSpan(3)
                            ->schema([
                                Textarea::make('corrective_action')
                                    ->label('Tindakan Korektif')
                                    ->required()
                                    ->rows(4),
                                Textarea::make('bentuk_pengendalian')
                                    ->label('Bentuk Pengendalian')
                                    ->required()
                                    ->rows(4),
                            ]),

                        Section::make('Metrik & Tanggung Jawab')
                            ->columnSpan(2)
                            ->schema([
                                Select::make('incident_id')
                                    ->label('ID Insiden')
                                    ->relationship('incident', 'id')
                                    ->required(),
                                TextInput::make('target_pengendalian')
                                    ->label('Target Pengendalian (Hari)')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('penanggung_jawab')
                                    ->label('Penanggung Jawab')
                                    ->required(),
                                TextInput::make('status')
                                    ->label('Status')
                                    ->required(),
                                TextInput::make('progress')
                                    ->label('Progress (%)')
                                    ->required()
                                    ->numeric(),
                            ]),
                    ]),
            ]);
    }
}
