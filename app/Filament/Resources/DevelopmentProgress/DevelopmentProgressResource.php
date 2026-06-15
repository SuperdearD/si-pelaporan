<?php

namespace App\Filament\Resources\DevelopmentProgress;

use App\Filament\Resources\DevelopmentProgress\Pages\ManageDevelopmentProgress;
use App\Models\DevelopmentProgress;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
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

class DevelopmentProgressResource extends Resource
{
    protected static ?string $model = DevelopmentProgress::class;

    protected static string|UnitEnum|null $navigationGroup = 'Pengembangan';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-chart-bar';

    public static function getNavigationLabel(): string
    {
        return __('Progress Harian/Mingguan');
    }

    public static function getModelLabel(): string
    {
        return __('Progress Pengembangan');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Data Progress Pengembangan');
    }

    protected static ?string $recordTitleAttribute = 'id';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'progress-pengembangan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(5)
                    ->schema([
                        Section::make('Rincian Progress')
                            ->columnSpan(3)
                            ->schema([
                                Textarea::make('hasil_progress')
                                    ->label('Hasil Pekerjaan')
                                    ->required()
                                    ->rows(6),
                            ]),

                        Section::make('Informasi Pelacakan')
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('incident_development_id')
                                    ->label('ID Pengembangan')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('message_id')
                                    ->label('ID Pesan / Referensi')
                                    ->required(),
                                TextInput::make('pic')
                                    ->label('PIC Pelapor')
                                    ->required(),
                                DatePicker::make('tanggal')
                                    ->label('Tanggal Laporan')
                                    ->required(),
                                TextInput::make('persentase')
                                    ->label('Persentase Progress (%)')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('file')
                                    ->label('File Lampiran'),
                            ]),
                    ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('incident_development_id')
                    ->numeric(),
                TextEntry::make('message_id'),
                TextEntry::make('pic'),
                TextEntry::make('tanggal')
                    ->date(),
                TextEntry::make('hasil_progress')
                    ->columnSpanFull(),
                TextEntry::make('persentase')
                    ->numeric(),
                TextEntry::make('file')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('incident_development_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('message_id')
                    ->searchable(),
                TextColumn::make('pic')
                    ->searchable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('persentase')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('file')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ManageDevelopmentProgress::route('/'),
        ];
    }
}
