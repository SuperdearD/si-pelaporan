<?php

namespace App\Filament\Resources\IncidentDevelopments\Pages;

use App\Filament\Resources\IncidentDevelopments\IncidentDevelopmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIncidentDevelopment extends EditRecord
{
    protected static string $resource = IncidentDevelopmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
