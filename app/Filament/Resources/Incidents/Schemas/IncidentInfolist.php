<?php

namespace App\Filament\Resources\Incidents\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncidentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->icon('heroicon-o-information-circle')
                    ->description('Detail waktu dan pelapor insiden.')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('date')
                            ->label('Tanggal Kejadian')
                            ->date('d F Y')
                            ->icon('heroicon-m-calendar-days')
                            ->iconColor('primary'),

                        TextEntry::make('time')
                            ->label('Waktu Kejadian')
                            ->time('H:i')
                            ->icon('heroicon-m-clock')
                            ->iconColor('primary'),

                        // ==========================================
                        // PERUBAHAN DISINI (MENYESUAIKAN MULTIPLE USERS)
                        // ==========================================
                        TextEntry::make('users.name') // Ganti dari user.name menjadi users.name
                            ->label('Pelapor / Karyawan')
                            ->weight('bold')
                            ->icon('heroicon-m-user-group') // Ubah icon jadi group
                            ->iconColor('primary')
                            ->badge() // Tambahkan badge agar nama-nama tampil dalam kotak rapi
                            ->separator(','), // Pembatas opsional jika data di-copy
                    ]),

                // SECTION 2: DETAIL PEKERJAAN
                Section::make('Detail Pekerjaan')
                    ->icon('heroicon-o-briefcase')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('department')
                            ->label('Departemen')
                            ->badge()
                            ->color('info'), // Diberi badge agar terlihat mencolok

                        TextEntry::make('position')
                            ->label('Jabatan'),

                        TextEntry::make('age')
                            ->label('Usia')
                            ->numeric()
                            ->suffix(' Tahun'),

                        TextEntry::make('work_experience')
                            ->label('Pengalaman Kerja'),

                        TextEntry::make('responsibility')
                            ->label('Tanggung Jawab Saat Kejadian')
                            ->columnSpanFull() // Memakan lebar penuh karena biasanya teksnya panjang
                            ->markdown(), // Jika teks mengandung formatting
                    ]),

                // SECTION 3: DETAIL KECELAKAAN
                Section::make('Detail Kecelakaan & Penyebab')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->schema([
                        Fieldset::make('Data Kecelakaan')
                            ->columns(3)
                            ->schema([
                                TextEntry::make('accident.accident_place')
                                    ->label('Tempat Kejadian')
                                    ->placeholder('Belum ada data'),

                                TextEntry::make('accident.accident_condition')
                                    ->label('Kondisi Kejadian')
                                    ->placeholder('Belum ada data'),

                                TextEntry::make('accident.safety_incidents')
                                    ->label('Klasifikasi Insiden')
                                    ->badge()
                                    ->color('danger')
                                    ->placeholder('Belum ada data'),

                                TextEntry::make('accident.accident_description')
                                    ->label('Deskripsi/Kronologi')
                                    ->columnSpanFull()
                                    ->limit(200)
                                    ->lineClamp(3)
                                    ->placeholder('Belum ada deskripsi'),

                                \Filament\Infolists\Components\ImageEntry::make('accident.photo')
                                    ->label('Foto Kejadian')
                                    ->columnSpanFull()
                                    ->hidden(fn ($state) => ! $state),
                            ]),

                        Fieldset::make('Analisis Penyebab (Root Cause)')
                            ->columns(3)
                            ->schema([
                                TextEntry::make('cause.unsafe_action')
                                    ->label('Unsafe Action')
                                    ->placeholder('-'),

                                TextEntry::make('cause.unsafe_condition')
                                    ->label('Unsafe Condition')
                                    ->placeholder('-'),

                                TextEntry::make('cause.person_factor')
                                    ->label('Faktor Personal')
                                    ->placeholder('-'),

                                TextEntry::make('cause.job_factor')
                                    ->label('Faktor Pekerjaan')
                                    ->placeholder('-'),

                                TextEntry::make('cause.env_factor')
                                    ->label('Faktor Lingkungan')
                                    ->placeholder('-'),
                            ]),
                    ]),

                // SECTION 4: METADATA SISTEM (Di-collapse secara default)
                Section::make('Log Sistem')
                    ->icon('heroicon-o-server')
                    ->collapsed() // Disembunyikan secara default agar UI tidak penuh
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d/m/Y H:i:s')
                            ->placeholder('-')
                            ->color('gray'),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diubah')
                            ->dateTime('d/m/Y H:i:s')
                            ->placeholder('-')
                            ->color('gray'),
                    ]),
            ]);
    }
}
