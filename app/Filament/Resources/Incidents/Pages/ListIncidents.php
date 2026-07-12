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
                    return $query->where('is_approved', false);
                })
                ->badge(\App\Models\Incident::where('is_approved', false)->count())
                ->badgeColor('warning'),

            'Disetujui' => Tab::make('Disetujui')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->where('is_approved', true)
                        ->whereDoesntHave('followUps', function ($query) {
                            $query->where('status_approval', 'Revisi');
                        });
                })
                ->badge(\App\Models\Incident::where('is_approved', true)
                    ->whereDoesntHave('followUps', function ($query) {
                        $query->where('status_approval', 'Revisi');
                    })->count())
                ->badgeColor('success'),

            'Direvisi' => Tab::make('Direvisi')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->whereHas('followUps', function ($query) {
                        $query->where('status_approval', 'Revisi');
                    });
                })
                ->badge(\App\Models\Incident::whereHas('followUps', function ($query) {
                    $query->where('status_approval', 'Revisi');
                })->count())
                ->badgeColor('danger'),
        ];
    }
}
