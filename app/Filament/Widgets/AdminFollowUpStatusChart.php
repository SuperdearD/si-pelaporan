<?php

namespace App\Filament\Widgets;

use App\Models\IncidentFollowUp;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class AdminFollowUpStatusChart extends ChartWidget
{
    protected ?string $heading = 'Rasio Status Penyelesaian (Tindak Lanjut)';
    protected static ?int $sort = 3;

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('Administrator');
    }

    protected function getData(): array
    {
        $open = IncidentFollowUp::where('status', 'open')->count();
        $onProgress = IncidentFollowUp::where('status', 'on_progress')->count();
        $closed = IncidentFollowUp::where('status', 'closed')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Status',
                    'data' => [$open, $onProgress, $closed],
                    'backgroundColor' => [
                        '#FFCE56', // Kuning (Open)
                        '#36A2EB', // Biru (On Progress)
                        '#4BC0C0', // Hijau tosca (Closed)
                    ],
                ],
            ],
            'labels' => ['Terbuka (Open)', 'Berjalan (On Progress)', 'Selesai (Closed)'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
