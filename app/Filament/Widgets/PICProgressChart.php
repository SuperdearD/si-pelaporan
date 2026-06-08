<?php

namespace App\Filament\Widgets;

use App\Models\IncidentFollowUp;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class PICProgressChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Progress Tindak Lanjut';
    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('PIC');
    }

    protected function getData(): array
    {
        // Mengelompokkan berdasarkan rentang persentase progress
        $range0_25 = IncidentFollowUp::query()->whereBetween('progress', [0, 25])->count();
        $range26_50 = IncidentFollowUp::query()->whereBetween('progress', [26, 50])->count();
        $range51_75 = IncidentFollowUp::query()->whereBetween('progress', [51, 75])->count();
        $range76_100 = IncidentFollowUp::query()->whereBetween('progress', [76, 100])->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Tugas',
                    'data' => [$range0_25, $range26_50, $range51_75, $range76_100],
                    'backgroundColor' => [
                        '#ef4444', // Merah (0-25%)
                        '#f59e0b', // Kuning/Amber (26-50%)
                        '#3b82f6', // Biru (51-75%)
                        '#10b981', // Hijau (76-100%)
                    ],
                ],
            ],
            'labels' => ['0 - 25%', '26 - 50%', '51 - 75%', '76 - 100%'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
