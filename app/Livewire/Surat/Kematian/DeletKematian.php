<?php

namespace App\Livewire\Surat\Kematian;

use Livewire\Component;
use App\Models\SuratKematian;

class DeletKematian extends Component
{
    public $isOpen = false;
    public $suratId;
    public $suratData = [];

    protected $listeners = ['deletKematian' => 'openModal'];

    public function openModal($data)
    {
        // dd('berhasil');

        $this->suratId = $data['id_kematian'];

        $surat = SuratKematian::find($this->suratId);

        if (!$surat) {
            session()->flash('error', "Surat dengan ID {$this->suratId} tidak ditemukan.");
            return;
        }

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->suratId = null;
        $this->suratData = [];
    }

    public function deletKematian()
    {
        try {
            $surat = SuratKematian::findOrFail($this->suratId);
            $surat->delete();

            $this->closeModal();
            $this->dispatch('kematianDeleted');
            $this->dispatch('showSuccessMessage', 'Surat kematian berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus surat kematian.');
        }
    }

    public function render()
    {
        return view('livewire.surat.kematian.delet-kematian');
    }
}
