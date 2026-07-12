<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan Insiden</title>
    <style>
        /* --- General Layout --- */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #2b2b2b;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* --- Header Section --- */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #0056b3;
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
            border-radius: 3px 3px 0 0;
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

        .table-info thead th {
            background-color: #e9ecef;
            color: #333;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
        }
        
        .text-center {
            text-align: center;
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
                <h2>Rekap Laporan Investigasi Insiden</h2>
                <p>CV Fitra Utama - Sistem Manajemen K3</p>
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

    <table class="table-info">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 10%;">Waktu</th>
                <th style="width: 20%;">Pelapor</th>
                <th style="width: 15%;">Departemen</th>
                <th style="width: 20%;">Klasifikasi Insiden</th>
                <th style="width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($incidents as $index => $incident)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        {{ strlen($incident->date) >= 8 ? \Carbon\Carbon::parse($incident->date)->format('d F Y') : ($incident->date ?? '-') }}
                    </td>
                    <td class="text-center">{{ $incident->time ?? '-' }} WITA</td>
                    <td>{{ $incident->users->pluck('name')->implode(', ') ?: '-' }}</td>
                    <td>{{ $incident->department ?? '-' }}</td>
                    <td>
                        {{ optional($incident->accident)->safety_incidents ?? '-' }}
                    </td>
                    <td class="text-center">
                        @if($incident->is_approved)
                            Disetujui
                        @else
                            Menunggu Persetujuan
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data insiden untuk direkap.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
