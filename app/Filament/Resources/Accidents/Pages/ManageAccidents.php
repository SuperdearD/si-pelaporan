<?php

namespace App\Filament\Resources\Accidents\Pages;

use App\Filament\Resources\Accidents\AccidentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAccidents extends ManageRecords
{
    protected static string $resource = AccidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
