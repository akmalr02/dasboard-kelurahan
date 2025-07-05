<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratKematian;

class KematianController extends Component
{
    protected string $layout = 'layouts.app';

    public $dataKematian;
    public $daftarKematian = [];
    public $showModal = false;
    public $selectedSurat = null;

    public function showDetail($id)
    {
        $this->selectedSurat = SuratKematian::with(['pelapor.rt', 'pelapor.rw'])->findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function mount()
    {
        // Ambil data surat kematian milik user yang sedang login
        $idWarga = Auth::user()->warga->id_warga ?? null;

        $this->dataKematian = SuratKematian::with(['pelapor'])
            ->where('id_pelapor', $idWarga)
            ->latest()
            ->get();
    }

    public function render()
    {
        // dd('berhasil kematian');
        return view('livewire.surat.kematian', [
            'title' => 'Pengajuan surat kematian',
            'kematianList' => $this->dataKematian
        ]);
    }
}
