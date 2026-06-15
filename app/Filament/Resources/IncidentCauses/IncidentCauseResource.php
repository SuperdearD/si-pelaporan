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
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class IncidentCauseResource extends Resource
{
    protected static ?string $model = IncidentCause::class;

    protected static string|UnitEnum|null $navigationGroup = 'Insiden & Kecelakaan';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-magnifying-glass';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-magnifying-glass';

    public static function getNavigationLabel(): string
    {
        return __('Akar Masalah');
    }

    public static function getModelLabel(): string
    {
        return __('Akar Masalah');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Data Akar Masalah');
    }

    protected static ?string $recordTitleAttribute = 'id';
    protected static ?int $navigationSort = 3;
    protected static ?string $slug = 'akar-masalah';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(5)
                    ->schema([
                        Section::make('Faktor Teknis & Lingkungan')
                            ->columnSpan(3)
                            ->schema([
                                Textarea::make('unsafe_action')
                                    ->label('Tindakan Tidak Aman (Unsafe Action)')
                                    ->required()
                                    ->rows(3),
                                Textarea::make('unsafe_condition')
                                    ->label('Kondisi Tidak Aman (Unsafe Condition)')
                                    ->required()
                                    ->rows(3),
                                Textarea::make('env_factor')
                                    ->label('Faktor Lingkungan Luar')
                                    ->required()
                                    ->rows(3),
                            ]),

                        Section::make('Faktor Manusia & Organisasi')
                            ->columnSpan(2)
                            ->schema([
                                Select::make('incident_id')
                                    ->label('ID Insiden')
                                    ->relationship('incident', 'id')
                                    ->required(),
                                Textarea::make('person_factor')
                                    ->label('Faktor Personal')
                                    ->required()
                                    ->rows(2),
                                Textarea::make('job_factor')
                                    ->label('Faktor Pekerjaan')
                                    ->required()
                                    ->rows(2),
                            ]),
                    ]),
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
