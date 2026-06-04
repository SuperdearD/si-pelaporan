<?php

namespace App\Filament\Resources\IncidentCauses;

use App\Filament\Resources\IncidentCauses\Pages\ManageIncidentCauses;
use App\Models\IncidentCause;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IncidentCauseResource extends Resource
{
    protected static ?string $model = IncidentCause::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('incident_id')
                    ->relationship('incident', 'id')
                    ->required(),
                Textarea::make('unsafe_action')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('unsafe_condition')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('person_factor')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('job_factor')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('env_factor')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('incident.id')
                    ->label('Incident'),
                TextEntry::make('unsafe_action')
                    ->columnSpanFull(),
                TextEntry::make('unsafe_condition')
                    ->columnSpanFull(),
                TextEntry::make('person_factor')
                    ->columnSpanFull(),
                TextEntry::make('job_factor')
                    ->columnSpanFull(),
                TextEntry::make('env_factor')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('incident.id')
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
            'index' => ManageIncidentCauses::route('/'),
        ];
    }
}
