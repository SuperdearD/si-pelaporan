<?php

namespace App\Filament\Widgets;

use App\Models\IncidentFollowUp;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class PICCompletionTrendChart extends ChartWidget
{
    protected ?string $heading = 'Tren Penyelesaian Tindak Lanjut (Tahun Ini)';
    protected static ?int $sort = 3;

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('PIC');
    }

    protected function getData(): array
    {
        // Mengambil tugas yang berstatus 'closed' dan dikelompokkan berdasarkan bulan (diambil dari updated_at)
        $closedTasks = IncidentFollowUp::query()
            ->selectRaw('MONTH(updated_at) as month, count(*) as count')
            ->where('status', 'closed')
            ->whereYear('updated_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $closedTasks[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tugas Diselesaikan',
                    'data' => $data,
                    'borderColor' => '#10b981', // Warna hijau garis
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)', // Hijau transparan untuk area bawah garis
                    'fill' => true, // Memberikan efek area chart
                    'tension' => 0.4, // Membuat garis sedikit melengkung (smooth)
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
