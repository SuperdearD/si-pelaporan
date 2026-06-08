<?php

namespace App\Filament\Widgets;

use App\Models\Incident;
use App\Models\IncidentFollowUp;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DirekturStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    // Memberikan kesan dinamis dengan auto-refresh setiap 15 detik
    protected ?string $pollingInterval = '15s';

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('Direktur');
    }

    protected function getStats(): array
    {
        $totalInsiden = Incident::query()->count();

        // Mengambil tindak lanjut yang belum di-approve (Null atau Menunggu)
        $menungguApproval = IncidentFollowUp::query()
            ->whereNull('status_approval')
            ->orWhere('status_approval', 'Menunggu')
            ->count();

        // PERBAIKAN: Menggunakan is_approved karena tabel incidents tidak memiliki kolom 'status'
        $insidenSelesai = Incident::query()
            ->where('is_approved', true)
            ->count();

        return [
            Stat::make('Total Insiden', $totalInsiden)
                ->description('Akumulasi seluruh insiden tercatat')
                ->descriptionIcon('heroicon-m-chart-bar-square')
                // Menggunakan warna gray untuk estetika yang lebih minimalis & elegan
                ->color('gray')
                // Menambahkan sparkline (grafik statis/dummy untuk visualisasi)
                ->chart([3, 4, 3, 6, 4, 7, 5, 8]),

            Stat::make('Action Required', $menungguApproval)
                ->description('Tindak lanjut menunggu otorisasi')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger')
                ->chart([1, 2, 1, 3, 2, 4, $menungguApproval]) // Ujung grafik mengikuti jumlah aktual
                ->extraAttributes([
                    // Efek cinematic: jika ada data, berikan efek pulse, ring merah, dan glowing shadow
                    'class' => $menungguApproval > 0
                        ? 'animate-pulse ring-1 ring-danger-500/50 shadow-[0_0_15px_rgba(244,63,94,0.3)] transition-all'
                        : '',
                ]),

            Stat::make('Insiden Disetujui', $insidenSelesai)
                ->description('Divalidasi & Selesai')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success')
                ->chart([1, 2, 4, 5, 7, 8, 10]), // Grafik tren naik
        ];
    }
}
