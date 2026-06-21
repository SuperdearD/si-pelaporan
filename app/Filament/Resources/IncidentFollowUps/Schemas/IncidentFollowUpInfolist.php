<?php

namespace App\Filament\Resources\IncidentFollowUps\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class IncidentFollowUpInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('incident.id')
                    ->label('Incident'),
                TextEntry::make('corrective_action')
                    ->columnSpanFull(),
                TextEntry::make('target_pengendalian')
                    ->label('Target Pengendalian (Hari)'),
                TextEntry::make('bentuk_pengendalian')
                    ->columnSpanFull(),
                TextEntry::make('penanggung_jawab'),
                TextEntry::make('status'),
                TextEntry::make('progress')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
