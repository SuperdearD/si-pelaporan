<?php

namespace App\Filament\Widgets;

use App\Models\IncidentFollowUp;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class PICStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('PIC');
    }

    protected function getStats(): array
    {
        // Catatan: Jika di masa depan PIC di-mapping menggunakan user_id,
        // Anda bisa menambahkan ->where('user_id', Auth::id()) di setiap query ini.
        // Untuk sekarang, kita asumsikan PIC melihat semua tindak lanjut yang aktif.

        $tugasAktif = IncidentFollowUp::query()
            ->whereIn('status', ['open', 'on_progress'])
            ->count();

        $butuhRevisi = IncidentFollowUp::query()
            ->where('status_approval', 'Revisi')
            ->count();

        $tugasSelesai = IncidentFollowUp::query()
            ->where('status', 'closed')
            ->count();

        return [
            Stat::make('Tugas Aktif (Berjalan)', $tugasAktif)
                ->description('Tindak lanjut yang harus dikerjakan')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('primary'),

            Stat::make('Butuh Perbaikan (Revisi)', $butuhRevisi)
                ->description('Dikembalikan oleh Direktur')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('danger')
                ->extraAttributes([
                    // Memberikan efek animasi "pulse" jika ada tugas yang direvisi
                    'class' => $butuhRevisi > 0 ? 'animate-pulse' : '',
                ]),

            Stat::make('Tugas Selesai', $tugasSelesai)
                ->description('Tindak lanjut yang sudah divalidasi')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
