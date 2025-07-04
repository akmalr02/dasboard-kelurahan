<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKelahiran;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportSuratController extends Controller
{
    public function downloadKelahiran($id)
    {
        $surat = SuratKelahiran::with(['ayah.rt.rw', 'ibu'])->findOrFail($id);

        if (!$surat->file_ttd_admin) {
            return back()->with('error', 'Surat belum ditandatangani!');
        }

        $pdf = Pdf::loadView('components.exports.kelahiran', ['surat' => $surat]);

        return $pdf->download('Surat_Kelahiran_' . $surat->nama_anak . '.pdf');
    }
}
