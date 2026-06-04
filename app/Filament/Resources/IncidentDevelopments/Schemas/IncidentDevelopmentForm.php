<?php

namespace App\Filament\Resources\IncidentDevelopments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class IncidentDevelopmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('incident_id')
                    ->relationship('incident', 'id')
                    ->required(),
                Textarea::make('bentuk_pengembangan')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('hasil_pengembangan')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('persentase')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
            ]);
    }
}
