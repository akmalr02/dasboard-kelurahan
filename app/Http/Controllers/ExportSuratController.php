<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\SuratKelahiran;
use App\Models\SuratKematian;
use App\Models\SuratPengantar;

class ExportSuratController extends Controller
{
    public function download($jenis, $id)
    {
        switch ($jenis) {
            case 'kelahiran':
                $surat = SuratKelahiran::with(['ayah.rt.rw', 'ibu'])->findOrFail($id);
                $view = 'components.exports.kelahiran';
                $filename = 'Surat_Kelahiran_' . $surat->nama_anak . '.pdf';
                break;

            case 'kematian':
                $surat = SuratKematian::with(['pelapor.rt.rw'])->findOrFail($id);
                $view = 'components.exports.kematian';
                $filename = 'Surat_Kematian_' . $surat->pelapor->name . '.pdf';
                break;

            case 'pengantar':
                $surat = SuratPengantar::with(['warga.rt.rw'])->findOrFail($id);
                $view = 'components.exports.pengantar';
                $filename = 'Surat_pengantar_' . $surat->warga->name . '.pdf';
                break;

            default:
                abort(404, 'Jenis surat tidak ditemukan.');
        }

        // Validasi apakah surat sudah ditandatangani
        if (
            ($jenis === 'kelahiran' && !$surat->file_ttd_admin) ||
            ($jenis === 'kematian' && !$surat->file_ttd_admin) ||
            ($jenis === 'pengantar' && (!$surat->file_ttd_rt || !$surat->file_ttd_rw))
        ) {
            return back()->with('error', 'Surat belum lengkap ditandatangani!');
        }

        // Pastikan view tersedia
        if (!View::exists($view)) {
            abort(500, "View {$view} tidak ditemukan.");
        }

        $pdf = Pdf::loadView($view, ['surat' => $surat]);
        return $pdf->download($filename);
    }
}
