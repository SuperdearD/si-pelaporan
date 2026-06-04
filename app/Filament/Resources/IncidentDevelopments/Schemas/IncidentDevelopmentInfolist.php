<?php

namespace App\Filament\Resources\IncidentDevelopments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class IncidentDevelopmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('incident.id')
                    ->label('Incident'),
                TextEntry::make('bentuk_pengembangan')
                    ->columnSpanFull(),
                TextEntry::make('hasil_pengembangan')
                    ->columnSpanFull(),
                TextEntry::make('persentase')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
