<?php

namespace App\Filament\Resources\DevelopmentReports;

use App\Filament\Resources\DevelopmentReports\Pages\ManageDevelopmentReports;
use App\Models\DevelopmentReport;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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

class DevelopmentReportResource extends Resource
{
    protected static ?string $model = DevelopmentReport::class;

    protected static string|UnitEnum|null $navigationGroup = 'Pengembangan';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-check';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-document-check';

    public static function getNavigationLabel(): string
    {
        return __('Laporan Akhir');
    }

    public static function getModelLabel(): string
    {
        return __('Laporan Akhir');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Laporan Akhir Pengembangan');
    }

    protected static ?string $recordTitleAttribute = 'message_id';
    protected static ?int $navigationSort = 3;
    protected static ?string $slug = 'laporan-pengembangan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(5)
                    ->schema([
                        Section::make('Rincian Laporan Akhir')
                            ->columnSpan(3)
                            ->schema([
                                Textarea::make('hasil')
                                    ->label('Hasil Aktual Akhir')
                                    ->required()
                                    ->rows(3),
                                Textarea::make('kesimpulan')
                                    ->label('Kesimpulan Laporan')
                                    ->required()
                                    ->rows(3),
                                Textarea::make('rekomendasi')
                                    ->label('Rekomendasi untuk Manajemen')
                                    ->required()
                                    ->rows(3),
                            ]),

                        Section::make('Informasi Referensi')
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('incident_development_id')
                                    ->label('ID Pengembangan')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('message_id')
                                    ->label('ID Laporan / Ref')
                                    ->required(),
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
                TextEntry::make('hasil')
                    ->columnSpanFull(),
                TextEntry::make('kesimpulan')
                    ->columnSpanFull(),
                TextEntry::make('rekomendasi')
                    ->columnSpanFull(),
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
            'index' => ManageDevelopmentReports::route('/'),
        ];
    }
}
