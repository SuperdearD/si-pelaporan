<?php

namespace App\Filament\Widgets;

use App\Models\Incident;
use App\Models\IncidentFollowUp;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    // PENTING: Widget ini hanya muncul untuk Administrator
    public static function canView(): bool
    {
        return Auth::user()?->hasRole('Administrator'); // Sesuaikan huruf besar/kecil dengan database role Anda
    }

    protected function getStats(): array
    {
        $totalIncidents = Incident::count();
        $totalFollowUps = IncidentFollowUp::count();
        $pendingApproval = Incident::where('is_approved', false)->count();

        return [
            Stat::make('Total Seluruh Insiden', $totalIncidents)
                ->description('Semua laporan di sistem')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary'),

            Stat::make('Total Tindak Lanjut', $totalFollowUps)
                ->description('Aksi perbaikan terdaftar')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('success'),

            Stat::make('Menunggu Persetujuan', $pendingApproval)
                ->description('Belum di-approve Direktur')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    // Opsional: jika diklik bisa diarahkan ke halaman insiden
                ]),
        ];
    }
}
