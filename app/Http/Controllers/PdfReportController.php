<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfReportController extends Controller
{
    public function streamSingleIncident(Incident $incident)
    {
        // 1. Ubah 'user' menjadi 'users'
        // 2. Sesuaikan nama relasi nested repeater (progress & report) sesuai skema form
        $incident->load([
            'users',
            'approvedBy',
            'accident',
            'cause',
            'followUps.followUpProgresses',
            'developments.developmentProgresses',
            'developments.developmentReports'
        ]);

        // Ambil data user yang memiliki role 'Direktur'
        // Memanfaatkan method dari Spatie Laravel Permission
        $direktur = User::role('Direktur')->first();

        // Lempar variabel $direktur ke view
        $pdf = Pdf::loadView('pdf.single-incident', compact('incident', 'direktur'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Laporan_Insiden_{$incident->id}.pdf");
    }

    public function streamRecapIncidents(Request $request)
    {
        $selectedIds = $request->input('ids', []);

        // Ubah 'user' menjadi 'users' pada query builder
        $incidents = Incident::with(['users', 'accident'])
            ->whereIn('id', $selectedIds)
            ->latest('date')
            ->get();

        $pdf = Pdf::loadView('pdf.recap-incidents', compact('incidents'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream("Rekap_Laporan_Insiden.pdf");
    }
}
