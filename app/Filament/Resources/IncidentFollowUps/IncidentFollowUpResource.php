<?php

namespace App\Filament\Resources\IncidentFollowUps;

use App\Filament\Resources\IncidentFollowUps\Pages\CreateIncidentFollowUp;
use App\Filament\Resources\IncidentFollowUps\Pages\EditIncidentFollowUp;
use App\Filament\Resources\IncidentFollowUps\Pages\ListIncidentFollowUps;
use App\Filament\Resources\IncidentFollowUps\Pages\ViewIncidentFollowUp;
use App\Filament\Resources\IncidentFollowUps\Schemas\IncidentFollowUpForm;
use App\Filament\Resources\IncidentFollowUps\Schemas\IncidentFollowUpInfolist;
use App\Filament\Resources\IncidentFollowUps\Tables\IncidentFollowUpsTable;
use App\Models\IncidentFollowUp;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IncidentFollowUpResource extends Resource
{
    protected static ?string $model = IncidentFollowUp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return IncidentFollowUpForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IncidentFollowUpInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncidentFollowUpsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIncidentFollowUps::route('/'),
            'create' => CreateIncidentFollowUp::route('/create'),
            'view' => ViewIncidentFollowUp::route('/{record}'),
            'edit' => EditIncidentFollowUp::route('/{record}/edit'),
        ];
    }
}
