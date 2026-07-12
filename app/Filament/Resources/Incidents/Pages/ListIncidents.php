<?php

namespace App\Filament\Resources\Incidents\Pages;

use App\Filament\Resources\Incidents\IncidentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListIncidents extends ListRecords
{
    protected static string $resource = IncidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Insiden')
                ->visible(fn(): bool => Auth::user()?->hasAnyRole(['User', 'Administrator'])),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Semua' => Tab::make('Semua')
                ->badge(\App\Models\Incident::count()),

            'Menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->where('status_laporan', 'Menunggu')
                        ->orWhere('is_approved', false);
                })
                ->badge(\App\Models\Incident::where('status_laporan', 'Menunggu')
                    ->orWhere('is_approved', false)->count())
                ->badgeColor('warning'),

            'Disetujui' => Tab::make('Disetujui')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->where('status_laporan', 'Disetujui')
                        ->where('status_tindak_lanjut', '!=', 'Revisi');
                })
                ->badge(\App\Models\Incident::where('status_laporan', 'Disetujui')
                    ->where('status_tindak_lanjut', '!=', 'Revisi')->count())
                ->badgeColor('success'),

            'Direvisi' => Tab::make('Direvisi')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->where('status_laporan', 'Revisi')
                        ->orWhere('status_tindak_lanjut', 'Revisi');
                })
                ->badge(\App\Models\Incident::where('status_laporan', 'Revisi')
                    ->orWhere('status_tindak_lanjut', 'Revisi')->count())
                ->badgeColor('danger'),
        ];
    }
}
