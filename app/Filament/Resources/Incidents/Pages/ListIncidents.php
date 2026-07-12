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
        $query = IncidentResource::getEloquentQuery();

        return [
            'Semua' => Tab::make('Semua')
                ->badge((clone $query)->count()),
            'Menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn(Builder $q) => $q->where('is_approved', false))
                ->badge((clone $query)->where('is_approved', false)->count())
                ->badgeColor('warning'),
            'Disetujui' => Tab::make('Disetujui')
                ->modifyQueryUsing(fn(Builder $q) => $q->where('is_approved', true)->whereDoesntHave('followUps', fn($f) => $f->where('status_approval', 'Revisi')))
                ->badge((clone $query)->where('is_approved', true)->whereDoesntHave('followUps', fn($f) => $f->where('status_approval', 'Revisi'))->count())
                ->badgeColor('success'),
            'Direvisi' => Tab::make('Direvisi')
                ->modifyQueryUsing(fn(Builder $q) => $q->whereHas('followUps', fn($f) => $f->where('status_approval', 'Revisi')))
                ->badge((clone $query)->whereHas('followUps', fn($f) => $f->where('status_approval', 'Revisi'))->count())
                ->badgeColor('danger'),
        ];
    }
}
