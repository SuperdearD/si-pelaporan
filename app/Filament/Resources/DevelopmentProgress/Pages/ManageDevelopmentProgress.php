<?php

namespace App\Filament\Resources\DevelopmentProgress\Pages;

use App\Filament\Resources\DevelopmentProgress\DevelopmentProgressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDevelopmentProgress extends ManageRecords
{
    protected static string $resource = DevelopmentProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
