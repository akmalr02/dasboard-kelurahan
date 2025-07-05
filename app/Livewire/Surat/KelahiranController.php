<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\SuratKelahiran;
use Illuminate\Support\Facades\Auth;

class KelahiranController extends Component
{
    protected string $layout = 'layouts.app';

    public $daftarSuratKelahiran = [];
    public $showModal = false;
    public $selectedSurat = null;

    public function showDetail($id)
    {
        $surat = $this->selectedSurat = SuratKelahiran::with(['ayah.rt.rw', 'ibu'])->findOrFail($id);
        if ($surat->id_ayah !== (Auth::user()->warga->id_warga ?? null)) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }

        $this->selectedSurat = $surat;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function render()
    {
        $idWarga = Auth::user()->warga->id_warga ?? null;

        $suratKelahiran = SuratKelahiran::with(['ayah.rt', 'ayah.rw', 'ibu'])
            ->where('id_ayah', $idWarga)
            ->latest()
            ->get();

        return view('livewire.surat.kelahiran', [
            'title' => 'Pengajuan surat Kelahiran',
            'suratKelahiran' => $suratKelahiran,
        ]);
    }
}
