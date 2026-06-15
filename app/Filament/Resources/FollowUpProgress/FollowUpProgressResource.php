<?php

namespace App\Filament\Resources\FollowUpProgress;

use App\Filament\Resources\FollowUpProgress\Pages\ManageFollowUpProgress;
use App\Models\FollowUpProgress;
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

class FollowUpProgressResource extends Resource
{
    protected static ?string $model = FollowUpProgress::class;

    protected static string|UnitEnum|null $navigationGroup = 'Tindak Lanjut';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static string|BackedEnum|null $activeNavigationIcon = 'heroicon-s-arrow-trending-up';

    public static function getNavigationLabel(): string
    {
        return __('Progress Perbaikan');
    }

    public static function getModelLabel(): string
    {
        return __('Progress Tindak Lanjut');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Data Progress Tindak Lanjut');
    }

    protected static ?string $recordTitleAttribute = 'id';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'progress-tindak-lanjut';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(5)
                    ->schema([
                        Section::make('Keterangan Progress')
                            ->columnSpan(3)
                            ->schema([
                                Textarea::make('keterangan')
                                    ->label('Keterangan / Detail Pekerjaan')
                                    ->required()
                                    ->rows(6),
                            ]),

                        Section::make('Informasi Pelacakan')
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('incident_follow_up_id')
                                    ->label('ID Tindak Lanjut')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('message_id')
                                    ->label('ID Pesan / Referensi')
                                    ->required(),
                                TextInput::make('pic')
                                    ->label('PIC Pelapor')
                                    ->required(),
                                TextInput::make('persentase_progress')
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
                TextEntry::make('incident_follow_up_id')
                    ->numeric(),
                TextEntry::make('message_id'),
                TextEntry::make('pic'),
                TextEntry::make('keterangan')
                    ->columnSpanFull(),
                TextEntry::make('persentase_progress')
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
                TextColumn::make('incident_follow_up_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('message_id')
                    ->searchable(),
                TextColumn::make('pic')
                    ->searchable(),
                TextColumn::make('persentase_progress')
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
            'index' => ManageFollowUpProgress::route('/'),
        ];
    }
}
