<?php

namespace App\Filament\Resources\Incidents\Tables;

use App\Models\Incident;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class IncidentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([

                // 1. Menggabungkan Tanggal & Waktu agar lebih minimalis
                TextColumn::make('date')
                    ->label('Waktu Kejadian')
                    ->date('d M Y')
                    ->description(fn($record): string => 'Pukul ' . \Carbon\Carbon::parse($record->time)->format('H:i'))
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-m-calendar-days')
                    ->iconColor('primary'),

                // 2. Menarik relasi Accident untuk memberikan Badge visual yang halus
                TextColumn::make('accident.safety_incidents')
                    ->label('Klasifikasi Insiden')
                    ->badge()
                    ->color('danger') // Memberikan aksen warna tanpa terlihat norak
                    ->searchable()
                    ->placeholder('Belum diisi'),

                // 3. Menggabungkan Pelapor, Departemen, dan Jabatan dalam satu kolom
                TextColumn::make('user.name')
                    ->label('Pelapor & Unit Kerja')
                    ->weight('bold') // Highlight nama pelapor
                    ->description(fn($record): string => $record->department . ' - ' . $record->position)
                    ->searchable(['name', 'department', 'position']) // Tetap bisa dicari berdasarkan dept/jabatan
                    ->sortable(),

                // 4. Kolom detail yang disembunyikan secara default (Toggleable) agar UI tetap clean
                TextColumn::make('age')
                    ->label('Usia')
                    ->numeric()
                    ->suffix(' Thn')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('work_experience')
                    ->label('Pengalaman')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('responsibility')
                    ->label('Tanggung Jawab')
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                // 5. Metadata Sistem
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('is_approved')
                    ->label('Status')
                    ->badge()
                    // Mengubah nilai boolean/0-1 menjadi teks Bahasa Indonesia
                    ->formatStateUsing(fn($state): string => $state ? 'Disetujui' : 'Menunggu')
                    // Memberikan warna dinamis (Hijau jika true, Kuning jika false)
                    ->color(fn($state): string => $state ? 'success' : 'warning')
                    // Menambahkan ikon agar lebih intuitif
                    ->icon(fn($state): string => $state ? 'heroicon-m-check-badge' : 'heroicon-m-clock')
                    ->sortable(),
            ])
            ->filters([
                // Filter sederhana untuk mempercepat pencarian data
                Filter::make('bulan_ini')
                    ->label('Insiden Bulan Ini')
                    ->query(fn(Builder $query): Builder => $query->whereMonth('date', now()->month)
                        ->whereYear('date', now()->year)),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Setujui Laporan')
                    ->icon('heroicon-o-check-badge')
                    ->button()
                    ->color('primary')
                    ->requiresConfirmation() // Mencegah klik tidak sengaja
                    ->modalHeading('Setujui Laporan Insiden')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui laporan ini? Nama Anda akan tercatat sebagai pihak yang menyetujui.')
                    ->modalSubmitActionLabel('Ya, Setujui')

                    // Cek role user (menggunakan method hasRole dari Spatie) dan pastikan belum disetujui
                    ->visible(fn(Incident $record): bool => Auth::user()->hasRole('Direktur') && !$record->is_approved)

                    // Logika saat tombol konfirmasi ditekan
                    ->action(function (Incident $record) {
                        $record->update([
                            'is_approved' => true,
                            'approved_by' => Auth::id(),
                        ]);

                        // Kirim notifikasi sukses ke layar
                        Notification::make()
                            ->title('Berhasil')
                            ->body('Laporan insiden berhasil disetujui.')
                            ->success()
                            ->send();
                    }),
                Action::make('cancel_approval')
                    ->label('Batal Setujui')
                    ->icon('heroicon-o-x-circle')
                    ->button()
                    ->color('danger')
                    ->requiresConfirmation() // Mencegah klik tidak sengaja
                    ->modalHeading('Batalkan Persetujuan Laporan')
                    ->modalDescription('Apakah Anda yakin ingin membatalkan persetujuan laporan ini? Status laporan akan kembali menjadi belum disetujui.')
                    ->modalSubmitActionLabel('Ya, Batalkan')

                    // Cek role user dan pastikan laporan SUDAH disetujui
                    ->visible(fn(Incident $record): bool => Auth::user()->hasRole('Direktur') && $record->is_approved)

                    // Logika saat tombol konfirmasi ditekan
                    ->action(function (Incident $record) {
                        $record->update([
                            'is_approved' => false,
                            'approved_by' => null, // Mengosongkan data penyetuju
                        ]);

                        // Kirim notifikasi sukses ke layar
                        Notification::make()
                            ->title('Dibatalkan')
                            ->body('Persetujuan laporan insiden berhasil dibatalkan.')
                            ->success()
                            ->send();
                    }),

                Action::make('cetak_pdf')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-printer')
                    ->button()
                    ->color('success')
                    ->url(fn(Incident $record): string => route('pdf.incident.single', $record))
                    ->openUrlInNewTab()
                    ->visible(fn(Incident $record): bool => $record->is_approved),
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ])

            ])
            ->toolbarActions([
                BulkAction::make('cetak_rekap')
                    ->label('Cetak Rekap PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('warning')
                    ->action(function (Collection $records) {
                        // Mengambil array ID yang dipilih user
                        $ids = $records->pluck('id')->toArray();

                        // Melempar ID ke route rekap yang sudah dibuat di controller
                        return redirect()->route('pdf.incident.recap', ['ids' => $ids]);
                    })
                    ->deselectRecordsAfterCompletion(),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped();
    }
}
