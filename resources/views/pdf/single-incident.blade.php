<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Investigasi Insiden</title>
    <style>
        /* --- General Layout --- */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            /* Ukuran standar dokumen formal */
            color: #2b2b2b;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* --- Header Section --- */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #0056b3;
            /* Garis biru korporat */
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .logo-cell {
            width: 15%;
            text-align: left;
            vertical-align: middle;
        }

        .logo-cell img {
            max-width: 120px;
            height: auto;
        }

        .logo-cell-right {
            width: 15%;
            text-align: right;
            vertical-align: middle;
        }

        .logo-cell-right img {
            max-width: 80px;
            height: auto;
        }

        .title-cell {
            width: 70%;
            text-align: center;
            vertical-align: middle;
        }

        .title-cell h2 {
            margin: 0 0 5px 0;
            text-transform: uppercase;
            font-size: 18px;
            color: #1a1a1a;
            letter-spacing: 0.5px;
        }

        .title-cell p {
            margin: 0;
            font-size: 12px;
            color: #555;
            font-weight: bold;
        }

        /* --- Section Titles --- */
        .section-title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #0056b3;
            color: #ffffff;
            padding: 6px 10px;
            margin-top: 20px;
            margin-bottom: 0;
            /* Menempel dengan tabel di bawahnya */
            border-radius: 3px 3px 0 0;
            /* Efek melengkung di atas */
        }

        /* --- Data Tables --- */
        .table-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        .table-info td,
        .table-info th {
            padding: 8px 10px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .table-info td.label {
            width: 20%;
            font-weight: bold;
            background-color: #f8f9fa;
            /* Abu-abu sangat terang */
            color: #333;
        }

        /* Khusus untuk tabel list/daftar (Tindak Lanjut) */
        .table-list thead th {
            background-color: #e9ecef;
            color: #333;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
        }

        /* --- Signature Section --- */
        .signature-box {
            width: 100%;
            margin-top: 50px;
            border-top: 1px dashed #ccc;
            padding-top: 20px;
        }

        .signature-table {
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        .signature-line {
            display: inline-block;
            width: 150px;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                @php
                    $imagePath = public_path('images/logo/logo_imm.png');
                    $imageData = '';
                    if (file_exists($imagePath)) {
                        $imageData = base64_encode(file_get_contents($imagePath));
                    }
                @endphp

                @if($imageData)
                    <img src="data:image/png;base64,{{ $imageData }}" alt="Logo">
                @endif
            </td>
            <td class="title-cell">
                <h2>Formulir Laporan Investigasi Insiden</h2>
                <p>CV Fitra Utama - Sistem Manajemen K3</p>
                <p style="font-weight: normal; margin-top: 3px; font-size: 10px;">Doc. No:
                    HSE-F-{{ str_pad($incident->id, 4, '0', STR_PAD_LEFT) }} | Rev: 00</p>
            </td>
            <td class="logo-cell-right">
                @php
                    $logoFitraPath = public_path('images/logo/logo_cv_fitra_utama.jpg');
                    $logoFitraData = '';
                    if (file_exists($logoFitraPath)) {
                        $logoFitraData = base64_encode(file_get_contents($logoFitraPath));
                    }
                @endphp

                @if($logoFitraData)
                    <img src="data:image/jpeg;base64,{{ $logoFitraData }}" alt="Logo Fitra Utama">
                @endif
            </td>
        </tr>
    </table>

    <div class="section-title">1. Informasi Umum</div>
    <table class="table-info">
        <tr>
            <td class="label">Tanggal Kejadian</td>
            <td style="width: 30%;">
                {{ strlen($incident->date) >= 8 ? \Carbon\Carbon::parse($incident->date)->format('d F Y') : ($incident->date ?? '-') }}
            </td>
            <td class="label">Waktu Kejadian</td>
            <td style="width: 30%;">{{ $incident->time ?? '-' }} WITA</td>
        </tr>
        <tr>
            <td class="label">Nama Pelapor</td>
            <td><strong>{{ $incident->users->pluck('name')->implode(', ') }}</strong></td>
            <td class="label">Departemen</td>
            <td>{{ $incident->department }}</td>
        </tr>
        <tr>
            <td class="label">Posisi / Jabatan</td>
            <td>{{ $incident->position }}</td>
            <td class="label">Usia / Pengalaman</td>
            <td>{{ $incident->age }} Thn / {{ $incident->work_experience }}</td>
        </tr>
    </table>

    <div class="section-title">2. Rincian Kecelakaan (Accident Details)</div>
    <table class="table-info">
        <tr>
            <td class="label">Lokasi Kejadian</td>
            <td>{{ $incident->accident->accident_place ?? '-' }}</td>
            <td class="label">Kondisi Kejadian</td>
            <td>{{ $incident->accident->accident_condition ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Kategori Insiden</td>
            <td colspan="3" style="font-weight: bold; color: #d9534f;">
                {{ strtoupper($incident->accident->safety_incidents ?? 'TIDAK DIKETAHUI') }}
            </td>
        </tr>
        <tr>
            <td class="label">Uraian / Kronologi</td>
            <td colspan="3">
                <div style="padding: 5px; background: #fafafa; border: 1px solid #eee;">
                    {!! $incident->accident->accident_description ?? '<em>Tidak ada uraian.</em>' !!}
                </div>
            </td>
        </tr>
        @if(!empty($incident->accident->photo))
        <tr>
            <td class="label">Foto Kejadian</td>
            <td colspan="3" style="text-align: center;">
                @php
                    $photoPath = storage_path('app/public/' . $incident->accident->photo);
                    $photoData = '';
                    $extension = 'jpeg';
                    if (file_exists($photoPath)) {
                        $extension = pathinfo($photoPath, PATHINFO_EXTENSION);
                        $photoData = base64_encode(file_get_contents($photoPath));
                    }
                @endphp
                @if($photoData)
                    <div style="margin: 10px 0;">
                        <img src="data:image/{{ $extension }};base64,{{ $photoData }}" alt="Foto Kejadian" style="max-height: 250px; max-width: 100%; border: 1px solid #ccc; padding: 3px; background: #fff;">
                    </div>
                @else
                    <em>Foto kejadian tidak ditemukan di server.</em>
                @endif
            </td>
        </tr>
        @endif
    </table>

    <div class="section-title">3. Analisis Akar Masalah (Root Cause Analysis)</div>
    <table class="table-info">
        <tr>
            <td class="label">Penyebab Langsung</td>
            <td colspan="3">
                <ul style="margin: 0; padding-left: 20px;">
                    <li><strong>Tindakan Tidak Aman (Unsafe Action):</strong> <br>
                        {{ $incident->cause->unsafe_action ?? '-' }}</li>
                    <li style="margin-top: 5px;"><strong>Kondisi Tidak Aman (Unsafe Condition):</strong> <br>
                        {{ $incident->cause->unsafe_condition ?? '-' }}</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="label">Penyebab Dasar</td>
            <td colspan="3">
                <ul style="margin: 0; padding-left: 20px;">
                    <li><strong>Faktor Personal:</strong> {{ $incident->cause->person_factor ?? '-' }}</li>
                    <li><strong>Faktor Pekerjaan:</strong> {{ $incident->cause->job_factor ?? '-' }}</li>
                    <li><strong>Faktor Lingkungan:</strong> {{ $incident->cause->env_factor ?? '-' }}</li>
                </ul>
            </td>
        </tr>
    </table>

    <div class="section-title">4. Rencana Tindakan Perbaikan (Corrective Action Plan)</div>
    <table class="table-info table-list">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 45%;">Tindakan Korektif</th>
                <th style="width: 15%;">Target Selesai</th>
                <th style="width: 20%;">Perusahaan Mitra</th>
                <th style="width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($incident->followUps as $index => $followUp)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        {{ $followUp->corrective_action }}
                        
                        @if($followUp->followUpProgresses && $followUp->followUpProgresses->count() > 0)
                            <div style="margin-top: 8px;">
                                @foreach($followUp->followUpProgresses as $progress)
                                    @if(!empty($progress->file))
                                        @php
                                            $photoPath = storage_path('app/public/' . $progress->file);
                                            $photoData = '';
                                            $extension = 'jpeg';
                                            if (file_exists($photoPath)) {
                                                $extension = pathinfo($photoPath, PATHINFO_EXTENSION);
                                                $photoData = base64_encode(file_get_contents($photoPath));
                                            }
                                        @endphp
                                        @if($photoData)
                                            <div style="display: inline-block; margin-right: 5px; margin-top: 5px; text-align: center;">
                                                <img src="data:image/{{ $extension }};base64,{{ $photoData }}" alt="Progress Photo" style="max-height: 80px; max-width: 120px; border: 1px solid #ccc; padding: 2px; background: #fff;"><br>
                                                <span style="font-size: 8px; color: #777;">{{ $progress->pic ?? 'Progress' }}</span>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        {{ $followUp->target_pengendalian ? $followUp->target_pengendalian . ' Hari' : '-' }}
                    </td>
                    <td style="text-align: center;">{{ $followUp->penanggung_jawab ?? '-' }}</td>
                    <td style="text-align: center; font-weight: bold;">
                        @if($followUp->status == 'done')
                            <span style="color: #28a745;">SELESAI</span>
                        @elseif($followUp->status == 'progress')
                            <span style="color: #ffc107;">PROSES</span>
                        @else
                            <span style="color: #dc3545;">TERBUKA</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; font-style: italic; color: #888;">Belum ada tindakan
                        perbaikan yang didaftarkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-box">
        @php
            use SimpleSoftwareIO\QrCode\Facades\QrCode;

            // Ambil semua nama pelapor yang digabungkan dengan koma
            $namaPelapor = $incident->users->pluck('name')->implode(', ');

            // Generate Payload QR Pembuat (Sudah diperbaiki)
            $payloadPembuat = "Dokumen Pelaporan K3 CV Fitra Utama\nDilaporkan oleh: " . $namaPelapor . "\nPada: " . $incident->created_at->format('d-m-Y H:i');
            $qrPembuat = base64_encode(QrCode::format('svg')->size(70)->generate($payloadPembuat));

            // Tentukan Nama Direktur
            // Jika sudah di-approve, gunakan nama user yang meng-approve.
            // Jika belum, gunakan default nama Direktur dari database.
            $namaDirektur = $incident->is_approved ? $incident->approvedBy?->name ?? 'Belum disetujui' : ($direktur ? $direktur->name : '( ..................................... )');

            // Generate Payload QR Direktur (Hanya muncul jika is_approved = true)
            $qrDirektur = null;
            if ($incident->is_approved) {
                $payloadDirektur = "Dokumen Validasi K3 CV Fitra Utama\nDisetujui oleh: " . $namaDirektur . "\nPada: " . $incident->updated_at->format('d-m-Y H:i');
                $qrDirektur = base64_encode(QrCode::format('svg')->size(70)->generate($payloadDirektur));
            }
        @endphp

        <table style="width: 100%; margin-top: 40px; text-align: center; font-size: 12px;">
            <tr>
                <td style="width: 50%; vertical-align: bottom;">
                    Dibuat Oleh,<br><br>

                    <img src="data:image/svg+xml;base64,{{ $qrPembuat }}" alt="QR Pelapor" style="margin: 10px 0;"><br>

                    <strong>{{ $incident->users->pluck('name')->implode(', ') }}</strong><br>
                    Pelapor
                </td>
                <td style="width: 50%; vertical-align: bottom;">
                    Diketahui Oleh,<br><br>

                    @if($qrDirektur)
                        <img src="data:image/svg+xml;base64,{{ $qrDirektur }}" alt="QR Direktur"
                            style="margin: 10px 0;"><br>
                    @else
                    <br><br><br><br> @endif

                    <strong>{{ $namaDirektur }}</strong><br>
                    Direktur
                </td>
            </tr>
        </table>
    </div>
</body>

</html>