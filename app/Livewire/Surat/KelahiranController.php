<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\SuratKelahiran;

class KelahiranController extends Component
{
    protected string $layout = 'layouts.app';

    public $daftarSuratKelahiran = [];
    public $showModal = false;
    public $selectedSurat = null;

    public function showDetail($id)
    {
        $this->selectedSurat = SuratKelahiran::with(['ayah.rt.rw', 'ibu'])->findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function render()
    {
        return view('livewire.surat.kelahiran', [
            'suratKelahiran' => SuratKelahiran::with(['ayah.rt', 'ayah.rw', 'ibu'])->latest()->get(),
        ]);
    }
}
