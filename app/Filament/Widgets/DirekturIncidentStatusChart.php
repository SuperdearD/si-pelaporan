<?php

namespace App\Filament\Widgets;

use App\Models\Incident;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class DirekturIncidentStatusChart extends ChartWidget
{
    protected ?string $heading = 'Rasio Persetujuan Insiden';
    protected static ?int $sort = 2;

    // Auto-refresh setiap 15 detik agar sinkron dengan Stats Overview
    protected ?string $pollingInterval = '15s';

    // Membatasi tinggi chart agar tampil proporsional dan minimalis di dashboard
    protected ?string $maxHeight = '275px';

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('Direktur');
    }

    protected function getData(): array
    {
        // Menggunakan is_approved sesuai skema database Anda
        $approved = Incident::where('is_approved', true)->count();
        $pending = Incident::where('is_approved', false)->orWhereNull('is_approved')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Total Laporan',
                    'data' => [$approved, $pending],
                    'backgroundColor' => [
                        'rgba(16, 185, 129, 0.2)', // Emerald transparan (Disetujui)
                        'rgba(244, 63, 94, 0.2)',  // Rose transparan (Menunggu)
                    ],
                    'borderColor' => [
                        '#10b981', // Garis pinggir solid Emerald
                        '#f43f5e', // Garis pinggir solid Rose
                    ],
                    'borderWidth' => 2, // Ketebalan border tegas
                    'hoverOffset' => 8, // Efek pop-out saat di-hover
                    'hoverBorderWidth' => 3,
                ],
            ],
            'labels' => ['Disetujui', 'Menunggu Persetujuan'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    // Menambahkan konfigurasi khusus Chart.js untuk tampilan minimalis & cinematic
    protected function getOptions(): array
    {
        return [
            // Membuat cincin doughnut lebih tipis dan elegan
            'cutout' => '75%',
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        // Mengubah kotak warna pada legend menjadi lingkaran/titik yang lebih rapi
                        'usePointStyle' => true,
                        'padding' => 20,
                    ],
                ],
            ],
        ];
    }
}
