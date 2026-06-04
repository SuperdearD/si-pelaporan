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
// use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class IncidentDevelopmentResource extends Resource
{
    protected static ?string $model = IncidentDevelopment::class;

    protected static string|UnitEnum|null $navigationGroup = 'Pengembangan';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-light-bulb';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-light-bulb';

    public static function getNavigationLabel(): string
    {
        return __('Rencana Pengembangan');
    }

    public static function getModelLabel(): string
    {
        return __('Pengembangan');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Data Pengembangan');
    }

    protected static ?string $recordTitleAttribute = 'bentuk_pengembangan';
    protected static ?int $navigationSort = 1;
    protected static ?string $slug = 'pengembangan-insiden';

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
