<?php

namespace App\Filament\Resources\IncidentDevelopments\Pages;

use App\Filament\Resources\IncidentDevelopments\IncidentDevelopmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIncidentDevelopment extends ViewRecord
{
    protected static string $resource = IncidentDevelopmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
