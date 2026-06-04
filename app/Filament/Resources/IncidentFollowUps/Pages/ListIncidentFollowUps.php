<?php

namespace App\Filament\Resources\IncidentFollowUps\Pages;

use App\Filament\Resources\IncidentFollowUps\IncidentFollowUpResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIncidentFollowUps extends ListRecords
{
    protected static string $resource = IncidentFollowUpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
