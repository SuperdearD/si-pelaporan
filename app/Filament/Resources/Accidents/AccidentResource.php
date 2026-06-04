<?php

namespace App\Filament\Resources\Accidents;

use App\Filament\Resources\Accidents\Pages\ManageAccidents;
use App\Models\Accident;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AccidentResource extends Resource
{
    protected static ?string $model = Accident::class;

    protected static string|UnitEnum|null $navigationGroup = 'Insiden & Kecelakaan';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-fire';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-fire';

    public static function getNavigationLabel(): string
    {
        return __('Kecelakaan');
    }

    public static function getModelLabel(): string
    {
        return __('Kecelakaan');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Data Kecelakaan');
    }

    protected static ?string $recordTitleAttribute = 'id';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'data-kecelakaan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('incident_id')
                    ->relationship('incident', 'id')
                    ->required(),
                TextInput::make('accident_place')
                    ->required(),
                TextInput::make('accident_condition')
                    ->required(),
                Textarea::make('accident_description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('safety_incidents')
                    ->required(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('incident.id')
                    ->label('Incident'),
                TextEntry::make('accident_place'),
                TextEntry::make('accident_condition'),
                TextEntry::make('accident_description')
                    ->columnSpanFull(),
                TextEntry::make('safety_incidents'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('incident.id')
                    ->searchable(),
                TextColumn::make('accident_place')
                    ->searchable(),
                TextColumn::make('accident_condition')
                    ->searchable(),
                TextColumn::make('safety_incidents')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAccidents::route('/'),
        ];
    }
}
