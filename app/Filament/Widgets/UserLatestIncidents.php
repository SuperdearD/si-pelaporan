<?php

namespace App\Filament\Widgets;

use App\Models\Incident;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserLatestIncidents extends TableWidget
{
    protected static ?int $sort = 2;

    // Agar tabel mengambil lebar penuh di dashboard
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Auth::user()?->hasRole('User');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ambil data milik user yang login, urutkan dari yang terbaru, batasi 5 data saja
                Incident::query()
                    ->whereHas('users', function (Builder $query) {
                        $query->where('users.id', Auth::id());
                    })
                    ->latest()
                    ->limit(5)
            )
            ->heading('5 Laporan Insiden Terakhir Anda')
            ->columns([
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('accident.safety_incidents')
                    ->label('Jenis Insiden')
                    ->limit(50)
                    ->placeholder('Belum diisi'),

                IconColumn::make('is_approved')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning'),
            ])
            // Matikan pagination karena kita hanya menampilkan limit 5 data
            ->paginated(false);
    }
}
