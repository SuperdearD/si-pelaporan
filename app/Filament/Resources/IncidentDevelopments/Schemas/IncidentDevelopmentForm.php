<?php

namespace App\Filament\Resources\IncidentDevelopments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncidentDevelopmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(5)
                    ->schema([
                        Section::make('Rencana & Target Pengembangan')
                            ->columnSpan(3)
                            ->schema([
                                Textarea::make('bentuk_pengembangan')
                                    ->label('Bentuk Pengembangan')
                                    ->required()
                                    ->rows(4),
                                Textarea::make('hasil_pengembangan')
                                    ->label('Hasil/Output Pengembangan')
                                    ->required()
                                    ->rows(4),
                            ]),

                        Section::make('Metrik & Penanggung Jawab')
                            ->columnSpan(2)
                            ->schema([
                                Select::make('incident_id')
                                    ->label('ID Insiden')
                                    ->relationship('incident', 'id')
                                    ->required(),
                                Select::make('user_id')
                                    ->label('PIC Pengembangan')
                                    ->relationship('user', 'name')
                                    ->required(),
                                DatePicker::make('tanggal')
                                    ->label('Tanggal Target')
                                    ->required(),
                                TextInput::make('status')
                                    ->label('Status')
                                    ->required(),
                                TextInput::make('persentase')
                                    ->label('Persentase (%)')
                                    ->required()
                                    ->numeric(),
                            ]),
                    ]),
            ]);
    }
}
