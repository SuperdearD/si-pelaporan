<?php

namespace App\Filament\Widgets;

use App\Models\Incident;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class AdminIncidentTrendChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Laporan Insiden Bulanan (Global)';
    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('Administrator');
    }

    protected function getData(): array
    {
        $incidents = Incident::selectRaw('MONTH(date) as month, count(*) as count')
            ->whereYear('date', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $incidents[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Insiden',
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        // Untuk Admin, Bar chart lebih tegas untuk membandingkan volume antar bulan
        return 'bar';
    }
}
