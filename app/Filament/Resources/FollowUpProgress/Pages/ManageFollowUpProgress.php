<?php

namespace App\Filament\Resources\FollowUpProgress\Pages;

use App\Filament\Resources\FollowUpProgress\FollowUpProgressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageFollowUpProgress extends ManageRecords
{
    protected static string $resource = FollowUpProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
