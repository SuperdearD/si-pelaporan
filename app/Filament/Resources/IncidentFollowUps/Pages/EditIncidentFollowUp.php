<?php

namespace App\Filament\Resources\IncidentFollowUps\Pages;

use App\Filament\Resources\IncidentFollowUps\IncidentFollowUpResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIncidentFollowUp extends EditRecord
{
    protected static string $resource = IncidentFollowUpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
