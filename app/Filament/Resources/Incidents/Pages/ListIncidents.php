<?php

namespace App\Filament\Resources\Incidents\Pages;

use App\Filament\Resources\Incidents\IncidentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
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
                ->badge($this->getEloquentQuery()->count()),
            'Menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn(\Illuminate\Database\Eloquent\Builder $query) => $query->where('is_approved', false))
                ->badge($this->getEloquentQuery()->where('is_approved', false)->count())
                ->badgeColor('warning'),
            'Disetujui' => Tab::make('Disetujui')
                ->modifyQueryUsing(fn(\Illuminate\Database\Eloquent\Builder $query) => $query->where('is_approved', true)->whereDoesntHave('followUps', fn($q) => $q->where('status_approval', 'Revisi')))
                ->badge($this->getEloquentQuery()->where('is_approved', true)->whereDoesntHave('followUps', fn($q) => $q->where('status_approval', 'Revisi'))->count())
                ->badgeColor('success'),
            'Direvisi' => Tab::make('Direvisi')
                ->modifyQueryUsing(fn(\Illuminate\Database\Eloquent\Builder $query) => $query->whereHas('followUps', fn($q) => $q->where('status_approval', 'Revisi')))
                ->badge($this->getEloquentQuery()->whereHas('followUps', fn($q) => $q->where('status_approval', 'Revisi'))->count())
                ->badgeColor('danger'),
        ];
    }
}
