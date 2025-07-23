<?php

namespace App\Livewire\Surat\Pengantar;

use Livewire\Component;
use App\Models\SuratPengantar;

class DeletPengantar extends Component
{
    public $isOpen = false;
    public $suratId;
    public $suratData = [];

    protected $listeners = ['deletPengantar' => 'openModal'];

    public function openModal($data)
    {
        $this->suratId = $data['id_pengajuan'];

        $surat = SuratPengantar::find($this->suratId);

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

    public function deletPengantar()
    {
        try {
            $surat = SuratPengantar::findOrFail($this->suratId);
            $surat->delete();

            $this->closeModal();
            $this->dispatch('pengantarDeleted');
            $this->dispatch('showSuccessMessage', 'Surat pengantar berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus surat pengantar.');
        }
    }

    public function render()
    {
        return view('livewire.surat.pengantar.delet-pengantar');
    }
}
