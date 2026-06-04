<?php

namespace App\Filament\Resources\IncidentFollowUps\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class IncidentFollowUpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('incident_id')
                    ->relationship('incident', 'id')
                    ->required(),
                Textarea::make('corrective_action')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('target_pengendalian')
                    ->required(),
                Textarea::make('bentuk_pengendalian')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('penanggung_jawab')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('progress')
                    ->required()
                    ->numeric(),
            ]);
    }
}
