<?php

namespace App\Filament\Resources\Incidents;

use App\Filament\Resources\Incidents\Pages\CreateIncident;
use App\Filament\Resources\Incidents\Pages\EditIncident;
use App\Filament\Resources\Incidents\Pages\ListIncidents;
use App\Filament\Resources\Incidents\Pages\ViewIncident;
use App\Filament\Resources\Incidents\Schemas\IncidentForm;
use App\Filament\Resources\Incidents\Schemas\IncidentInfolist;
use App\Filament\Resources\Incidents\Tables\IncidentsTable;
use App\Models\Incident;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class IncidentResource extends Resource
{
    protected static ?string $model = Incident::class;
    // Mengelompokkan menu di sidebar agar terlihat rapi
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Insiden & ERT';

    // Ikon saat menu tidak sedang dibuka
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    // Ikon solid/penuh saat menu sedang aktif (memberikan kesan UI yang dinamis)
    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::ExclamationTriangle;

    // Label pada navigasi sidebar
    public static function getNavigationLabel(): string
    {
        return __('Laporan Insiden');
    }

    // Label tunggal untuk penamaan tombol (cth: "Create Insiden", "Edit Insiden")
    public static function getModelLabel(): string
    {
        return __('Insiden');
    }

    // Label jamak untuk judul halaman utama (cth: "Daftar Insiden")
    public static function getPluralModelLabel(): string
    {
        return __('Data Insiden');
    }

    // Menentukan atribut untuk global search (diubah karena model Incident tidak punya kolom 'name')
    protected static ?string $recordTitleAttribute = 'department';

    // Urutan menu di sidebar (angka kecil akan berada di atas)
    protected static ?int $navigationSort = 1;

    // URL kustom agar terlihat lebih SEO-friendly / profesional
    protected static ?string $slug = 'laporan-insiden';

    public static function form(Schema $schema): Schema
    {
        return IncidentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IncidentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncidentsTable::configure($table);
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
            'index' => ListIncidents::route('/'),
            'create' => CreateIncident::route('/create'),
            'view' => ViewIncident::route('/{record}'),
            'edit' => EditIncident::route('/{record}/edit'),
        ];
    }
}
