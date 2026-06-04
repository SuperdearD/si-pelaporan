<?php

namespace App\Filament\Resources\IncidentDevelopments;

use App\Filament\Resources\IncidentDevelopments\Pages\CreateIncidentDevelopment;
use App\Filament\Resources\IncidentDevelopments\Pages\EditIncidentDevelopment;
use App\Filament\Resources\IncidentDevelopments\Pages\ListIncidentDevelopments;
use App\Filament\Resources\IncidentDevelopments\Pages\ViewIncidentDevelopment;
use App\Filament\Resources\IncidentDevelopments\Schemas\IncidentDevelopmentForm;
use App\Filament\Resources\IncidentDevelopments\Schemas\IncidentDevelopmentInfolist;
use App\Filament\Resources\IncidentDevelopments\Tables\IncidentDevelopmentsTable;
use App\Models\IncidentDevelopment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IncidentDevelopmentResource extends Resource
{
    protected static ?string $model = IncidentDevelopment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return IncidentDevelopmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IncidentDevelopmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncidentDevelopmentsTable::configure($table);
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
            'index' => ListIncidentDevelopments::route('/'),
            'create' => CreateIncidentDevelopment::route('/create'),
            'view' => ViewIncidentDevelopment::route('/{record}'),
            'edit' => EditIncidentDevelopment::route('/{record}/edit'),
        ];
    }
}
