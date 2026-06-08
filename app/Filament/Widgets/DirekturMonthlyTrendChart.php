<?php

namespace App\Filament\Widgets;

use App\Models\Incident;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class DirekturMonthlyTrendChart extends ChartWidget
{
    protected ?string $heading = 'Tren Insiden (Tahun Ini)';
    protected static ?int $sort = 3;

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('Direktur');
    }

    protected function getData(): array
    {
        // Mengambil jumlah insiden per bulan di tahun ini
        $monthlyIncidents = Incident::query()
            ->selectRaw('MONTH(created_at) as month, count(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyIncidents[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Insiden Baru',
                    'data' => $data,
                    'backgroundColor' => '#6366f1', // Indigo color untuk bar
                    'borderRadius' => 4, // Membuat ujung bar sedikit melengkung (UI modern)
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
