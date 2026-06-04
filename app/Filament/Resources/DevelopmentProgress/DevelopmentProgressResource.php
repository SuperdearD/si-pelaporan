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
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DevelopmentProgressResource extends Resource
{
    protected static ?string $model = DevelopmentProgress::class;

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
                TextInput::make('pic')
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                Textarea::make('hasil_progress')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('persentase')
                    ->required()
                    ->numeric(),
                TextInput::make('file'),
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
