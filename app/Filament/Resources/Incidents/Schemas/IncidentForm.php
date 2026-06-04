<?php

namespace App\Filament\Resources\Incidents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class IncidentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Manajemen Insiden')
                    ->columnSpanFull()
                    ->tabs([

                        // TAB 1: INFORMASI UTAMA
                        Tabs\Tab::make('Data Insiden')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Informasi Waktu & Pelapor')
                                    ->description('Masukkan detail dasar kapan insiden terjadi dan siapa yang melapor.')
                                    ->columns(3)
                                    ->schema([
                                        DatePicker::make('date')
                                            ->label('Tanggal Kejadian')
                                            ->native(false)
                                            ->displayFormat('d/m/Y')
                                            ->placeholder('Pilih tanggal kejadian')
                                            ->helperText('Pastikan tanggal sesuai dengan log lapangan.')
                                            ->required(),
                                        TimePicker::make('time')
                                            ->label('Waktu Kejadian')
                                            ->native(false)
                                            ->placeholder('Pilih waktu (Jam:Menit)')
                                            ->helperText('Waktu spesifik saat insiden terjadi.')
                                            ->required(),
                                        Select::make('user_id')
                                            ->label('Pelapor / Karyawan')
                                            ->relationship('user', 'name')
                                            ->native(false)
                                            ->searchable()
                                            ->preload()
                                            ->placeholder('Pilih nama karyawan...')
                                            ->helperText('Karyawan yang bertindak sebagai pelapor utama.')
                                            ->required(),
                                    ]),

                                Section::make('Informasi Pekerjaan')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('department')
                                            ->label('Departemen')
                                            ->placeholder('Cth: Gudang Sparepart, Produksi')
                                            ->helperText('Unit kerja pelapor atau korban.')
                                            ->required(),
                                        TextInput::make('position')
                                            ->label('Jabatan')
                                            ->placeholder('Cth: Clerk, Operator, Staff')
                                            ->helperText('Jabatan struktural pada saat insiden.')
                                            ->required(),
                                        TextInput::make('age')
                                            ->label('Usia')
                                            ->numeric()
                                            ->suffix('Tahun')
                                            ->placeholder('Cth: 28')
                                            ->helperText('Usia aktual saat kejadian.')
                                            ->required(),
                                        TextInput::make('work_experience')
                                            ->label('Pengalaman Kerja')
                                            ->placeholder('Cth: 3 Tahun 2 Bulan')
                                            ->helperText('Lama masa kerja di posisi saat ini.')
                                            ->required(),
                                        TextInput::make('responsibility')
                                            ->label('Tanggung Jawab Saat Insiden')
                                            ->columnSpanFull()
                                            ->placeholder('Cth: Melakukan receiving material ZRM / ZSP di area loading dock...')
                                            ->helperText('Aktivitas spesifik atau pekerjaan yang sedang diinstruksikan oleh atasan.')
                                            ->required(),
                                    ]),
                            ]),

                        // TAB 2: DETAIL & PENYEBAB
                        Tabs\Tab::make('Kecelakaan & Penyebab')
                            ->icon('heroicon-o-exclamation-triangle')
                            ->schema([
                                Repeater::make('accident')
                                    ->relationship('accident')
                                    ->label('Detail Kecelakaan')
                                    ->addActionLabel('Isi Data Kecelakaan')
                                    ->maxItems(1)
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('accident_place')
                                            ->label('Tempat Kejadian')
                                            ->placeholder('Cth: Area Loading Dock Gudang A')
                                            ->helperText('Lokasi spesifik di dalam pabrik/fasilitas.')
                                            ->required(),
                                        TextInput::make('accident_condition')
                                            ->label('Kondisi Kejadian')
                                            ->placeholder('Cth: Area licin karena tumpahan cairan')
                                            ->helperText('Kondisi lingkungan fisik saat insiden.')
                                            ->required(),
                                        TextInput::make('safety_incidents')
                                            ->label('Insiden Keselamatan')
                                            ->placeholder('Cth: Terpeleset, Kejatuhan Barang')
                                            ->helperText('Klasifikasi jenis insiden.')
                                            ->columnSpanFull()
                                            ->required(),
                                        Textarea::make('accident_description')
                                            ->label('Deskripsi Kecelakaan')
                                            ->columnSpanFull()
                                            ->placeholder('Ceritakan kronologi singkat kejadian dari awal hingga terjadi insiden...')
                                            ->helperText('Berikan detail yang jelas tanpa opini pribadi.')
                                            ->rows(4)
                                            ->required(),
                                    ]),

                                Repeater::make('cause')
                                    ->relationship('cause')
                                    ->label('Penyebab Insiden')
                                    ->addActionLabel('Isi Penyebab Insiden')
                                    ->maxItems(1)
                                    ->collapsible()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('unsafe_action')
                                            ->label('Tindakan Tidak Aman (Unsafe Action)')
                                            ->placeholder('Cth: Bekerja terburu-buru, tidak pakai APD')
                                            ->helperText('Perilaku manusia yang melanggar standar keselamatan.'),
                                        TextInput::make('unsafe_condition')
                                            ->label('Kondisi Tidak Aman (Unsafe Condition)')
                                            ->placeholder('Cth: Pencahayaan minim, lantai tidak rata')
                                            ->helperText('Kondisi lingkungan atau alat yang membahayakan.'),
                                        TextInput::make('person_factor')
                                            ->label('Faktor Personal')
                                            ->placeholder('Cth: Kelelahan, kurang konsentrasi')
                                            ->helperText('Kondisi fisik atau mental pekerja.'),
                                        TextInput::make('job_factor')
                                            ->label('Faktor Pekerjaan')
                                            ->placeholder('Cth: Beban kerja berlebih, SOP tidak jelas')
                                            ->helperText('Sistem atau prosedur kerja yang berkontribusi.'),
                                        TextInput::make('env_factor')
                                            ->label('Faktor Lingkungan')
                                            ->columnSpanFull()
                                            ->placeholder('Cth: Hujan deras, debu pekat')
                                            ->helperText('Kondisi eksternal di luar kendali.'),
                                    ]),
                            ]),

                        // TAB 3: TINDAK LANJUT
                        Tabs\Tab::make('Tindak Lanjut')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->badge(fn($record) => $record?->followUps()?->count() ?: null)
                            ->schema([
                                Repeater::make('followUps')
                                    ->relationship('followUps')
                                    ->label('Daftar Tindak Lanjut')
                                    ->addActionLabel('Tambah Tindak Lanjut')
                                    ->collapsible()
                                    ->itemLabel(fn(array $state): ?string => $state['corrective_action'] ?? null)
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('corrective_action')
                                            ->label('Tindakan Korektif')
                                            ->placeholder('Cth: Pemasangan anti-slip')
                                            ->helperText('Aksi langsung untuk mengatasi masalah.')
                                            ->required(),
                                        TextInput::make('target_pengendalian')
                                            ->label('Target Pengendalian')
                                            ->placeholder('Cth: 30')
                                            ->helperText('Lama Waktu Pengerjaan.')
                                            ->suffix('Hari')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('bentuk_pengendalian')
                                            ->label('Bentuk Pengendalian')
                                            ->placeholder('Cth: Engineering Control')
                                            ->helperText('Hierarki pengendalian risiko.')
                                            ->required(),
                                        TextInput::make('penanggung_jawab')
                                            ->label('Penanggung Jawab')
                                            ->placeholder('Cth: Tim Maintenance')
                                            ->helperText('Pihak yang mengeksekusi perbaikan.')
                                            ->required(),
                                        Select::make('status')
                                            ->options([
                                                'open' => 'Open',
                                                'on_progress' => 'On Progress',
                                                'closed' => 'Closed',
                                            ])
                                            ->native(false)
                                            ->placeholder('Pilih status perbaikan')
                                            ->helperText('Status terkini dari tindakan korektif.')
                                            ->required(),
                                        TextInput::make('progress')
                                            ->label('Progress (%)')
                                            ->numeric()
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->suffix('%')
                                            ->placeholder('0 - 100')
                                            ->helperText('Persentase penyelesaian.'),
                                    ]),
                            ]),

                        // TAB 4: PENGEMBANGAN
                        Tabs\Tab::make('Pengembangan')
                            ->icon('heroicon-o-light-bulb')
                            ->badge(fn($record) => $record?->developments()?->count() ?: null)
                            ->schema([
                                Repeater::make('developments')
                                    ->relationship('developments')
                                    ->label('Pengembangan Sistem / Preventif')
                                    ->addActionLabel('Tambah Pengembangan')
                                    ->collapsible()
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('bentuk_pengembangan')
                                            ->label('Bentuk Pengembangan')
                                            ->placeholder('Cth: Review JSA & SOP Material Handling')
                                            ->helperText('Tindakan preventif jangka panjang.')
                                            ->required(),
                                        TextInput::make('hasil_pengembangan')
                                            ->label('Target Hasil')
                                            ->placeholder('Cth: SOP baru tersosialisasi')
                                            ->helperText('Output yang diharapkan.')
                                            ->required(),
                                        Select::make('user_id')
                                            ->label('PIC Pengembangan')
                                            ->relationship('user', 'name')
                                            ->native(false)
                                            ->searchable()
                                            ->placeholder('Pilih Penanggung Jawab (PIC)')
                                            ->helperText('Karyawan yang memimpin inisiatif ini.'),
                                        DatePicker::make('tanggal')
                                            ->label('Target Selesai')
                                            ->native(false)
                                            ->displayFormat('d/m/Y')
                                            ->placeholder('Pilih tenggat waktu')
                                            ->helperText('Batas waktu penyelesaian pengembangan.'),
                                        Select::make('status')
                                            ->options([
                                                'pending' => 'Pending',
                                                'active' => 'Active',
                                                'completed' => 'Completed',
                                            ])
                                            ->native(false)
                                            ->placeholder('Pilih status pengembangan')
                                            ->helperText('Fase pengembangan saat ini.'),
                                        TextInput::make('persentase')
                                            ->label('Persentase (%)')
                                            ->numeric()
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->suffix('%')
                                            ->placeholder('0 - 100')
                                            ->helperText('Progres pengembangan sistem.'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
