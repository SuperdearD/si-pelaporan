<?php

use App\Http\Controllers\PdfReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin/print')->group(function () {
    Route::get('/incident/{incident}', [PdfReportController::class, 'streamSingleIncident'])->name('pdf.incident.single');
    Route::post('/incidents/recap', [PdfReportController::class, 'streamRecapIncidents'])->name('pdf.incident.recap');
});
