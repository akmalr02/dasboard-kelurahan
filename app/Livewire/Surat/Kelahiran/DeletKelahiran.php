<?php

namespace App\Livewire\Surat\Kelahiran;

use Livewire\Component;
use App\Models\SuratKelahiran;
use Illuminate\Routing\Route;
use Symfony\Component\Routing\Router;

class DeletKelahiran extends Component
{
    public $isOpen = false;
    public $suratId;
    public $suratData = [];

    protected $listeners = ['deletKelahiran' => 'openModal'];

    public function openModal($data)
    {
        // dd('berhasil');

        $this->suratId = $data['id_kelahiran'];

        $surat = SuratKelahiran::find($this->suratId);

        if (!$surat) {
            session()->flash('error', "Surat dengan ID {$this->suratId} tidak ditemukan.");
            return;
        }

        $this->isOpen = true;
    }

    public function closeModal()
    {
        // dd('Modal ditutup');
        $this->isOpen = false;
        $this->suratId = null;
        $this->suratData = [];
    }

    public function deletKelahiran()
    {
        try {
            $surat = SuratKelahiran::findOrFail($this->suratId);
            // dd($surat);
            $surat->delete();

            $this->closeModal();
            // $this->dispatch('kelahiranDeleted');
            // Kirim pesan sukses ke frontend
            $this->dispatch('showSuccessMessage', 'Surat kelahiran berhasil dihapus.');

            // Redirect ke route 'kelahiran'
            return redirect()->route('kelahiran');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus surat kematian.');
        }
    }

    public function render()
    {
        return view('livewire.surat.kelahiran.delet-kelahiran');
    }
}
