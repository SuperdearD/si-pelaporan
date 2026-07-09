<?php

namespace App\Filament\Resources\Incidents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class IncidentForm
{
    public static function configure(Schema $schema): Schema
    {
        // Pengecekan Role secara dinamis
        $isReadOnlyIncident = fn() => Auth::user()?->hasAnyRole(['PIC', 'Direktur']);
        $isReadOnlyAction = fn() => Auth::user()?->hasAnyRole(['User', 'Direktur']);
        $canEditAction = fn() => Auth::user()?->hasAnyRole(['PIC', 'Administrator']);
        $canEditIncident = fn() => Auth::user()?->hasAnyRole(['User', 'Administrator']);

        return $schema
            ->components([
                Tabs::make('Manajemen Insiden')
                    ->columnSpanFull()
                    ->tabs([

                        // =====================================
                        // TAB 1: DATA INSIDEN
                        // =====================================
                        Tabs\Tab::make('Data Insiden')
                            ->icon('heroicon-m-clipboard-document-list')
                            ->visible($canEditIncident)
                            ->schema([
                                Grid::make(5)
                                    ->schema([
                                        Section::make('Informasi Pekerjaan')
                                            ->description('Data pekerjaan karyawan saat insiden terjadi.')
                                            ->icon('heroicon-m-briefcase')
                                            ->disabled($isReadOnlyIncident)
                                            ->collapsible()
                                            ->columnSpan(3)
                                            ->columns(2)
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('department')
                                                        ->label('Departemen')
                                                        ->prefixIcon('heroicon-m-building-office')
                                                        ->placeholder('Cth: Mining Operation, HSE, Plant...')
                                                        ->required(),

                                                    TextInput::make('position')
                                                        ->label('Jabatan')
                                                        ->prefixIcon('heroicon-m-identification')
                                                        ->placeholder('Cth: Operator HD 785, Mekanik, Foreman...')
                                                        ->required(),
                                                ]),

                                                Grid::make(2)->schema([
                                                    TextInput::make('age')
                                                        ->label('Usia')
                                                        ->numeric()
                                                        ->suffix('Tahun')
                                                        ->placeholder('Cth: 32')
                                                        ->required(),

                                                    TextInput::make('work_experience')
                                                        ->label('Masa Kerja')
                                                        ->placeholder('Cth: 4 Tahun 2 Bulan')
                                                        ->required(),
                                                ]),

                                                TextInput::make('responsibility')
                                                    ->label('Tanggung Jawab Pekerjaan Saat Insiden')
                                                    ->columnSpanFull()
                                                    ->placeholder('Cth: Mengoperasikan unit HD 785 untuk hauling OB di Pit West...')
                                                    ->required(),
                                            ]),

                                        Section::make('Informasi Waktu & Pelapor')
                                            ->description('Detail dasar kapan insiden terjadi dan siapa pelapornya.')
                                            ->icon('heroicon-m-calendar-days')
                                            ->disabled($isReadOnlyIncident)
                                            ->collapsible()
                                            ->columnSpan(2)
                                            ->columns(1)
                                            ->schema([
                                                DatePicker::make('date')
                                                    ->label('Tanggal Kejadian')
                                                    ->native(false)
                                                    ->displayFormat('d M Y')
                                                    ->prefixIcon('heroicon-m-calendar')
                                                    ->placeholder('Pilih tanggal kejadian')
                                                    ->required(),

                                                TimePicker::make('time')
                                                    ->label('Waktu Kejadian')
                                                    ->native(false)
                                                    ->prefixIcon('heroicon-m-clock')
                                                    ->placeholder('Cth: 14:30')
                                                    ->required(),

                                                Select::make('users')
                                                    ->label('Pelapor / Karyawan')
                                                    ->relationship('users', 'nip')
                                                    ->native(false)
                                                    ->searchable()
                                                    ->preload()
                                                    ->prefixIcon('heroicon-m-user')
                                                    ->hintIcon('heroicon-m-information-circle', tooltip: 'Pilih karyawan yang melaporkan kejadian')
                                                    ->placeholder('Cari NIP karyawan...')
                                                    ->multiple()
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),

                        // =====================================
                        // TAB 2: KECELAKAAN & PENYEBAB
                        // =====================================
                        Tabs\Tab::make('Kecelakaan & Penyebab')
                            ->icon('heroicon-m-exclamation-triangle')
                            ->badgeColor('danger')
                            ->visible($canEditIncident)
                            ->schema([
                                Grid::make(5)
                                    ->schema([
                                        Repeater::make('accident')
                                            ->relationship('accident')
                                            ->label('Kronologi & Kondisi Kecelakaan')
                                            ->addActionLabel('Tambah Data Kecelakaan')
                                            ->maxItems(1)
                                            ->collapsible()
                                            ->collapsed()
                                            ->itemLabel(fn(array $state): ?string => $state['accident_place'] ?? 'Data Kecelakaan')
                                            ->disabled($isReadOnlyIncident)
                                            ->addable($canEditIncident)
                                            ->deletable($canEditIncident)
                                            ->columnSpan(3)
                                            ->columns(2)
                                            ->schema([
                                                TextInput::make('accident_place')
                                                    ->label('Tempat Kejadian')
                                                    ->prefixIcon('heroicon-m-map-pin')
                                                    ->placeholder('Cth: Hauling Road KM 12, Pit Bintang...')
                                                    ->required(),

                                                TextInput::make('accident_condition')
                                                    ->label('Kondisi Kejadian')
                                                    ->hint('Kondisi cuaca/lingkungan fisik')
                                                    ->placeholder('Cth: Hujan deras, jalanan licin dan berlumpur...')
                                                    ->required(),

                                                TextInput::make('safety_incidents')
                                                    ->label('Jenis Insiden Keselamatan')
                                                    ->placeholder('Cth: Unit Amblas, Menabrak Tanggul (Bund Wall), Tergelincir...')
                                                    ->columnSpanFull()
                                                    ->required(),

                                                Textarea::make('accident_description')
                                                    ->label('Deskripsi Lengkap Kecelakaan')
                                                    ->placeholder('Ceritakan kronologi kejadian secara detail. Cth: Saat unit melewati tikungan KM 12 dalam kondisi hujan, operator kehilangan kendali dan...')
                                                    ->columnSpanFull()
                                                    ->rows(4)
                                                    ->required(),

                                                FileUpload::make('photo')
                                                    ->label('Foto Kejadian (Opsional)')
                                                    ->disk('public')
                                                    ->directory('accident-photos')
                                                    ->image()
                                                    ->imagePreviewHeight('150')
                                                    ->columnSpanFull(),
                                            ]),

                                        Repeater::make('cause')
                                            ->relationship('cause')
                                            ->label('Analisis Penyebab (Root Cause)')
                                            ->addActionLabel('Isi Penyebab Insiden')
                                            ->maxItems(1)
                                            ->collapsible()
                                            ->collapsed()
                                            ->itemLabel('Analisis Penyebab Insiden')
                                            ->disabled($isReadOnlyIncident)
                                            ->addable($canEditIncident)
                                            ->deletable($canEditIncident)
                                            ->columnSpan(2)
                                            ->schema([
                                                Fieldset::make('Faktor Keselamatan')
                                                    ->columns(1)
                                                    ->schema([
                                                        TextInput::make('unsafe_action')
                                                            ->label('Tindakan Tidak Aman (Unsafe Action)')
                                                            ->helperText('Perilaku manusia yang memicu insiden.')
                                                            ->placeholder('Cth: Mengemudi melebihi batas kecepatan (Overspeed)...'),
                                                        TextInput::make('unsafe_condition')
                                                            ->label('Kondisi Tidak Aman (Unsafe Condition)')
                                                            ->helperText('Kondisi fisik lingkungan yang berbahaya.')
                                                            ->placeholder('Cth: Tinggi tanggul (bund wall) kurang dari standar / Blind spot...'),
                                                    ]),
                                                Fieldset::make('Faktor Lainnya')
                                                    ->columns(1)
                                                    ->schema([
                                                        TextInput::make('person_factor')
                                                            ->label('Faktor Personal')
                                                            ->placeholder('Cth: Microsleep, Kelelahan (Fatigue), Kurang konsentrasi...'),
                                                        TextInput::make('job_factor')
                                                            ->label('Faktor Pekerjaan')
                                                            ->placeholder('Cth: Kurangnya pengawasan dari Supervisor di lapangan...'),
                                                        TextInput::make('env_factor')
                                                            ->label('Faktor Lingkungan Luar')
                                                            ->columnSpanFull()
                                                            ->placeholder('Cth: Hujan ekstrem yang menyebabkan jarak pandang terbatas...'),
                                                    ])
                                            ]),
                                    ])
                            ]),

                        // =====================================
                        // TAB 3: TINDAK LANJUT
                        // =====================================
                        Tabs\Tab::make('Tindak Lanjut')
                            ->icon('heroicon-m-wrench-screwdriver')
                            ->badge(fn($record) => $record?->followUps()?->count() ?: null)
                            ->badgeColor('warning')
                            ->visible($canEditAction)
                            ->schema([
                                Repeater::make('followUps')
                                    ->relationship('followUps')
                                    ->label('Rencana & Aksi Tindak Lanjut')
                                    ->addActionLabel('Tambah Tindak Lanjut')
                                    ->collapsible()
                                    ->collapsed()
                                    ->disabled($isReadOnlyAction)
                                    ->addable($canEditAction)
                                    ->deletable($canEditAction)
                                    ->itemLabel(fn(array $state): ?string => ($state['corrective_action'] ?? 'Tindak Lanjut Baru') . ' — ' . strtoupper($state['status'] ?? ''))
                                    ->columns(3)
                                    ->schema([
                                        Hidden::make('status_approval'),
                                        TextInput::make('corrective_action')
                                            ->label('Tindakan Korektif')
                                            ->placeholder('Cth: Memperbaiki tanggul jalan di KM 12 dan sosialisasi SOP...')
                                            ->required()
                                            ->columnSpan(2),
                                        Select::make('status')
                                            ->options([
                                                'open' => 'Open',
                                                'on_progress' => 'On Progress',
                                                'closed' => 'Closed'
                                            ])
                                            ->native(false)
                                            ->placeholder('Pilih status')
                                            ->required(),

                                        TextInput::make('target_pengendalian')
                                            ->label('Target Waktu')
                                            ->suffix('Hari')
                                            ->placeholder('Cth: 7')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('bentuk_pengendalian')
                                            ->label('Bentuk Pengendalian')
                                            ->placeholder('Cth: Engineering Control, Administrasi...')
                                            ->required(),
                                        TextInput::make('penanggung_jawab')
                                            ->label('Penanggung Jawab (PIC)')
                                            ->prefixIcon('heroicon-m-user-circle')
                                            ->placeholder('Cth: Dept. Head Mining / Pengawas Lapangan')
                                            ->required(),
                                        TextInput::make('progress')
                                            ->label('Progress (%)')
                                            ->numeric()
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->placeholder('Cth: 50')
                                            ->suffix('%'),

                                        Textarea::make('catatan_revisi')
                                            ->label('Catatan Revisi dari Pimpinan')
                                            ->columnSpan(2)
                                            // Logika muncul: hanya jika status_approval adalah 'Revisi'
                                            ->visible(fn(Get $get): bool => $get('status_approval') === 'Revisi')
                                            // Opsional: Agar PIC hanya bisa baca, tidak bisa ubah catatan revisi
                                            ->readOnly(),

                                        // NESTED REPEATER
                                        Repeater::make('followUpProgresses')
                                            ->relationship('followUpProgresses')
                                            ->label('Update Progress Harian/Mingguan')
                                            ->addActionLabel('Tambah Laporan Progress')
                                            ->collapsible()
                                            ->collapsed()
                                            ->itemLabel(fn(array $state): ?string => $state['pic'] ?? 'Progress Update')
                                            ->columnSpanFull()
                                            ->columns(2)
                                            ->schema([
                                                TextInput::make('message_id')
                                                    ->label('ID Pesan/Referensi')
                                                    ->placeholder('Cth: PRG-26-001')
                                                    ->required(),
                                                TextInput::make('pic')
                                                    ->label('PIC Update')
                                                    ->placeholder('Cth: Budi (Foreman)')
                                                    ->required(),
                                                TextInput::make('persentase_progress')
                                                    ->label('Capaian (%)')
                                                    ->placeholder('Cth: 20')
                                                    ->numeric()
                                                    ->suffix('%'),
                                                FileUpload::make('file')
                                                    ->label('Bukti File/Foto (Opsional)')
                                                    ->disk('public')
                                                    ->directory('progress-files')
                                                    ->imagePreviewHeight('150'),
                                                Textarea::make('keterangan')
                                                    ->label('Catatan Progress')
                                                    ->placeholder('Cth: Grading jalan sudah dilakukan 30%, tanggul mulai ditimbun...')
                                                    ->columnSpanFull(),
                                            ])
                                    ]),
                            ]),

                        // =====================================
                        // TAB 4: PENGEMBANGAN
                        // =====================================
                        Tabs\Tab::make('Pengembangan')
                            ->icon('heroicon-m-light-bulb')
                            ->badge(fn($record) => $record?->developments()?->count() ?: null)
                            ->visible($canEditAction)
                            ->badgeColor('success')
                            ->schema([
                                Repeater::make('developments')
                                    ->relationship('developments')
                                    ->label('Pengembangan & Tindakan Preventif')
                                    ->addActionLabel('Tambah Rencana Pengembangan')
                                    ->collapsible()
                                    ->collapsed()
                                    ->disabled($isReadOnlyAction)
                                    ->addable($canEditAction)
                                    ->deletable($canEditAction)
                                    ->itemLabel(fn(array $state): ?string => $state['bentuk_pengembangan'] ?? 'Pengembangan Baru')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('bentuk_pengembangan')
                                            ->label('Bentuk Pengembangan')
                                            ->placeholder('Cth: Instalasi sistem sensor fatigue otomatis pada unit berat...')
                                            ->required()
                                            ->columnSpan(2),
                                        Select::make('status')
                                            ->options(['pending' => 'Pending', 'active' => 'Active', 'completed' => 'Completed'])
                                            ->native(false)
                                            ->placeholder('Pilih status'),

                                        TextInput::make('hasil_pengembangan')
                                            ->label('Target Hasil / Output')
                                            ->placeholder('Cth: Operator langsung tersadar saat terdeteksi micro-sleep...')
                                            ->required(),
                                        Select::make('user_id')
                                            ->label('PIC Pengembangan')
                                            ->relationship('user', 'name')
                                            ->native(false)
                                            ->placeholder('Cari PIC terkait...')
                                            ->searchable(),
                                        DatePicker::make('tanggal')
                                            ->label('Target Tanggal Selesai')
                                            ->placeholder('Pilih tanggal')
                                            ->native(false),

                                        TextInput::make('persentase')
                                            ->label('Total Persentase (%)')
                                            ->numeric()
                                            ->suffix('%')
                                            ->maxValue(100)
                                            ->placeholder('Cth: 100')
                                            ->columnSpanFull(),

                                        // NESTED REPEATER: Progress
                                        Repeater::make('developmentProgresses')
                                            ->relationship('developmentProgresses')
                                            ->label('Histori Progress Pengembangan')
                                            ->addActionLabel('Catat Progress')
                                            ->collapsible()
                                            ->collapsed()
                                            ->itemLabel(fn(array $state): ?string => $state['tanggal'] ?? 'Update Progress')
                                            ->columnSpanFull()
                                            ->columns(2)
                                            ->schema([
                                                TextInput::make('message_id')
                                                    ->label('Message ID')
                                                    ->placeholder('Cth: DEV-MSG-01')
                                                    ->required(),
                                                TextInput::make('pic')
                                                    ->label('Pelapor / PIC')
                                                    ->placeholder('Cth: Andi (Engineering)')
                                                    ->required(),
                                                DatePicker::make('tanggal')
                                                    ->label('Tanggal Update')
                                                    ->placeholder('Pilih tanggal')
                                                    ->native(false)
                                                    ->required(),
                                                TextInput::make('persentase')
                                                    ->label('Progress Harian (%)')
                                                    ->placeholder('Cth: 50')
                                                    ->numeric()
                                                    ->suffix('%'),
                                                FileUpload::make('file')
                                                    ->disk('public')
                                                    ->label('Lampiran Dokumen/Foto')
                                                    ->directory('dev-progress'),
                                                Textarea::make('hasil_progress')
                                                    ->label('Rincian Hasil Pekerjaan')
                                                    ->placeholder('Cth: Alat sensor sudah tiba di site dan siap diinstal di 5 unit pertama...')
                                                    ->columnSpanFull(),
                                            ]),

                                        // NESTED REPEATER: Reports
                                        Repeater::make('developmentReports')
                                            ->relationship('developmentReports')
                                            ->label('Laporan Final / Penutupan')
                                            ->addActionLabel('Buat Laporan Akhir')
                                            ->maxItems(1)
                                            ->collapsible()
                                            ->collapsed()
                                            ->itemLabel('Kesimpulan & Rekomendasi Akhir')
                                            ->columnSpanFull()
                                            ->columns(1)
                                            ->schema([
                                                TextInput::make('message_id')
                                                    ->label('Message ID / Ref. Laporan')
                                                    ->placeholder('Cth: REP-FINAL-001')
                                                    ->required(),
                                                Textarea::make('hasil')
                                                    ->label('Hasil Aktual Akhir')
                                                    ->placeholder('Cth: Sensor berhasil terpasang di 20 unit HD dan berfungsi dengan baik...')
                                                    ->rows(3)
                                                    ->required(),
                                                Textarea::make('kesimpulan')
                                                    ->label('Kesimpulan Laporan')
                                                    ->placeholder('Cth: Sistem efektif dalam memberikan peringatan dini ke operator sehingga menekan risiko insiden...')
                                                    ->rows(3)
                                                    ->required(),
                                                Textarea::make('rekomendasi')
                                                    ->label('Rekomendasi untuk Manajemen')
                                                    ->placeholder('Cth: Direkomendasikan untuk memasang sensor ini pada unit medium seperti Excavator PC2000...')
                                                    ->rows(3)
                                                    ->required(),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
