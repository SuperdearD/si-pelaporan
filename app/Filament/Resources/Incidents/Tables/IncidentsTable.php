<?php

namespace App\Filament\Resources\Incidents\Tables;

use App\Models\Incident;
use App\Models\IncidentFollowUp;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Size;
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

                // ==========================================
                // 3. PERUBAHAN DISINI (MULTIPLE USERS)
                // ==========================================
                TextColumn::make('users.name') // Ubah dari user.name menjadi users.name
                    ->label('Pelapor & Unit Kerja')
                    ->weight('bold')
                    ->badge() // Tambahkan badge agar nama-nama pelapor tampil rapi
                    ->description(fn($record): string => $record->department . ' - ' . $record->position)
                    ->searchable(), // Cukup searchable() agar Filament otomatis mencari di tabel users (Hapus sortable karena array multiple user tidak bisa di-sort langsung oleh SQL)

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

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(function (Incident $record): string {
                        if ($record->status_laporan === 'Revisi') {
                            return 'Revisi Laporan';
                        }
                        if ($record->status_tindak_lanjut === 'Revisi') {
                            return 'Revisi Tindak Lanjut';
                        }
                        if (!$record->is_approved || $record->status_laporan === 'Menunggu') {
                            return 'Menunggu';
                        }
                        return 'Disetujui';
                    })
                    ->formatStateUsing(function (string $state): string {
                        $user = Auth::user();
                        if ($state === 'Revisi Laporan') {
                            return $user?->hasRole('User') ? 'Revisi' : 'Revisi Laporan';
                        }
                        if ($state === 'Revisi Tindak Lanjut') {
                            return $user?->hasRole('PIC') ? 'Revisi' : 'Revisi PIC';
                        }
                        return $state;
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Disetujui' => 'success',
                        'Revisi Laporan', 'Revisi Tindak Lanjut' => 'danger',
                        default => 'primary',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'Menunggu' => 'heroicon-m-clock',
                        'Disetujui' => 'heroicon-m-check-badge',
                        'Revisi Laporan', 'Revisi Tindak Lanjut' => 'heroicon-m-arrow-path',
                        default => 'heroicon-m-information-circle',
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('is_approved', $direction);
                    }),
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
                    ->color('success') // Ubah ke success agar lebih jelas
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Laporan Insiden')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui laporan ini?')
                    ->modalSubmitActionLabel('Ya, Setujui')
                    ->visible(fn(Incident $record): bool => Auth::user()->hasAnyRole(['Direktur', 'Pimpinan']) && !$record->is_approved)
                    ->action(function (Incident $record) {
                        $record->update(['is_approved' => true, 'approved_by' => Auth::id(), 'status_laporan' => 'Disetujui']);
                        Notification::make()->title('Berhasil')->body('Laporan disetujui.')->success()->send();
                    }),

                Action::make('revisi_laporan')
                    ->label('Revisi Laporan')
                    ->icon('heroicon-o-arrow-path')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Revisi Laporan Insiden')
                    ->form([
                        Textarea::make('catatan_revisi')->label('Catatan Revisi')->required()->maxLength(255),
                    ])
                    ->visible(fn(Incident $record): bool => Auth::user()->hasAnyRole(['Direktur', 'Pimpinan']) && !$record->is_approved)
                    ->action(function (Incident $record, array $data) {
                        $userName = Auth::user()?->name ?? 'Pimpinan';
                        $newNote = "[" . now()->format('d M Y, H:i') . " - " . $userName . "]\n" . $data['catatan_revisi'];
                        $oldNote = $record->catatan_revisi_laporan;
                        $combinedNote = $oldNote ? $oldNote . "\n\n" . $newNote : $newNote;
                        
                        $record->update([
                            'status_laporan' => 'Revisi',
                            'catatan_revisi_laporan' => $combinedNote,
                        ]);
                        
                        Notification::make()->title('Revisi Terkirim')->warning()->send();
                    }),

                // Grup 2: Status Tindak Lanjut
                ActionGroup::make([
                    Action::make('setujui_tindak_lanjut')
                        ->label('Setujui Tindak Lanjut')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Setujui Tindak Lanjut')
                        ->visible(
                            fn(Incident $record): bool =>
                            Auth::user()?->hasAnyRole(['Direktur', 'Pimpinan']) &&
                            $record->is_approved &&
                            $record->followUps()->where('progress', '>=', 100)->where('status', 'on_progress')->exists()
                        )
                        ->action(function (Incident $record) {
                            $record->followUps()->where('progress', '>=', 100)->where('status', 'on_progress')
                                ->update(['status_approval' => 'Disetujui', 'status' => 'closed']);
                            $record->update(['status_tindak_lanjut' => 'Disetujui']);
                            Notification::make()->title('Tindak Lanjut Disetujui')->success()->send();
                        }),

                    Action::make('revisi_tindak_lanjut')
                        ->label('Revisi Tindak Lanjut')
                        ->icon('heroicon-o-arrow-path')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Revisi Tindak Lanjut')
                        ->form([
                            Textarea::make('catatan_revisi')->label('Catatan Revisi')->required()->maxLength(255),
                        ])
                        ->visible(
                            fn(Incident $record): bool =>
                            Auth::user()?->hasAnyRole(['Direktur', 'Pimpinan']) &&
                            $record->is_approved &&
                            $record->followUps()->where('progress', '>=', 100)->where('status', 'on_progress')->exists()
                        )
                        ->action(function (Incident $record, array $data) {
                            $followUps = $record->followUps()->where('progress', '>=', 100)->where('status', 'on_progress')->get();
                            
                            $userName = Auth::user()?->name ?? 'Pimpinan';
                            $newNote = "[" . now()->format('d M Y, H:i') . " - " . $userName . "]\n" . $data['catatan_revisi'];

                            foreach ($followUps as $followUp) {
                                $oldNote = $followUp->catatan_revisi;
                                $combinedNote = $oldNote ? $oldNote . "\n\n" . $newNote : $newNote;
                                
                                $followUp->update([
                                    'status_approval' => 'Revisi',
                                    'progress' => 50,
                                    'catatan_revisi' => $combinedNote,
                                ]);
                            }
                            
                            $oldIncidentNote = $record->catatan_revisi_tindak_lanjut;
                            $combinedIncidentNote = $oldIncidentNote ? $oldIncidentNote . "\n\n" . $newNote : $newNote;

                            $record->update([
                                'status_tindak_lanjut' => 'Revisi',
                                'catatan_revisi_tindak_lanjut' => $combinedIncidentNote,
                            ]);
                            
                            Notification::make()->title('Revisi Terkirim')->warning()->send();
                        }),
                ])
                    ->label('Status Tindak Lanjut')
                    ->button()
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->color('warning'),

                EditAction::make()
                    ->label(fn() => Auth::user()?->hasRole('PIC') ? 'Tindak Lanjut' : 'Ubah')
                    ->icon(fn() => Auth::user()?->hasRole('PIC') ? 'heroicon-o-wrench-screwdriver' : 'heroicon-o-pencil-square')
                    ->color(fn() => Auth::user()?->hasRole('PIC') ? 'warning' : 'primary')
                    ->button()
                    ->outlined()

                    // Kunci (Disable) tombol jika user adalah PIC dan insiden BELUM di-approve
                    ->disabled(fn(Incident $record): bool => Auth::user()?->hasRole('PIC') && !$record->is_approved)

                    // Tambahkan keterangan jika di-hover saat di-disable
                    ->tooltip(
                        fn(Incident $record): ?string =>
                        (Auth::user()?->hasRole('PIC') && !$record->is_approved)
                        ? 'Laporan harus disetujui terlebih dahulu sebelum Tindak Lanjut'
                        : null
                    ),

                Action::make('cetak_pdf')
                    ->label('')
                    ->icon('heroicon-o-printer')
                    ->iconButton()
                    ->size(Size::ExtraLarge)
                    ->color('success')
                    ->url(fn(Incident $record): string => route('pdf.incident.single', $record))
                    ->openUrlInNewTab()
                    ->visible(fn(Incident $record): bool => $record->is_approved),

                ActionGroup::make([
                    ViewAction::make(),
                    DeleteAction::make(),
                ]),

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
