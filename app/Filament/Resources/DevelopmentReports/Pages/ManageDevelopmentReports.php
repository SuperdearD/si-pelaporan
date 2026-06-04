<?php

namespace App\Filament\Resources\DevelopmentReports\Pages;

use App\Filament\Resources\DevelopmentReports\DevelopmentReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDevelopmentReports extends ManageRecords
{
    protected static string $resource = DevelopmentReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
