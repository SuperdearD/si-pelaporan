<?php

namespace App\Filament\Resources\IncidentCauses\Pages;

use App\Filament\Resources\IncidentCauses\IncidentCauseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageIncidentCauses extends ManageRecords
{
    protected static string $resource = IncidentCauseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
