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
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DevelopmentReportResource extends Resource
{
    protected static ?string $model = DevelopmentReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('incident_development_id')
                    ->required()
                    ->numeric(),
                TextInput::make('message_id')
                    ->required(),
                Textarea::make('hasil')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('kesimpulan')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('rekomendasi')
                    ->required()
                    ->columnSpanFull(),
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
