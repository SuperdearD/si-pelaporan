<?php

namespace App\Filament\Resources\IncidentFollowUps\Pages;

use App\Filament\Resources\IncidentFollowUps\IncidentFollowUpResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIncidentFollowUp extends ViewRecord
{
    protected static string $resource = IncidentFollowUpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
