<?php

namespace App\Filament\Widgets;

use App\Models\Incident;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UserStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    // Batasi agar hanya role 'user' (atau 'pelapor') yang bisa melihat
    public static function canView(): bool
    {
        return Auth::user()?->hasRole('User'); // Sesuaikan nama role Anda, misal: 'pelapor'
    }

    protected function getStats(): array
    {
        $userId = Auth::id();

        // Gunakan ->query() dan filter berdasarkan user_id serta bulan ini
        $myTotal = Incident::query()
            ->where('user_id', $userId)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();
            
        $myPending = Incident::query()
            ->where('user_id', $userId)
            ->where('is_approved', false)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();
            
        $myApproved = Incident::query()
            ->where('user_id', $userId)
            ->where('is_approved', true)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();

        return [
            Stat::make('Laporan Saya', $myTotal)
                ->description('Total insiden yang Anda laporkan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Menunggu Review', $myPending)
                ->description('Belum di-approve oleh Direktur/Admin')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Disetujui / Diproses', $myApproved)
                ->description('Laporan telah divalidasi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
