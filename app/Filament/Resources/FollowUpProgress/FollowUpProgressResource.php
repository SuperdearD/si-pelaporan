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
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FollowUpProgressResource extends Resource
{
    protected static ?string $model = FollowUpProgress::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('incident_follow_up_id')
                    ->required()
                    ->numeric(),
                TextInput::make('message_id')
                    ->required(),
                TextInput::make('pic')
                    ->required(),
                Textarea::make('keterangan')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('persentase_progress')
                    ->required()
                    ->numeric(),
                TextInput::make('file'),
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
