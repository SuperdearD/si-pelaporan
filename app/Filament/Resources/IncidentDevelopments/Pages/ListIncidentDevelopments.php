<?php

namespace App\Filament\Resources\IncidentDevelopments\Pages;

use App\Filament\Resources\IncidentDevelopments\IncidentDevelopmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIncidentDevelopments extends ListRecords
{
    protected static string $resource = IncidentDevelopmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
