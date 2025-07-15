<?php

namespace App\Livewire\Surat\Kelahiran;

use Livewire\Component;

class DetailKelahiran extends Component
{
    public $isOpen = false;
    public $selectedSurat = null;

    protected $listeners = ['showKelahiranModal', 'closeModal'];

    public function showKelahiranModal($surat)
    {
        $this->reset('selectedSurat');
        $this->selectedSurat = $surat;
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedSurat = null;
        $this->dispatch('modalClosed');
    }

    public function render()
    {
        return view('livewire.surat.kelahiran.detail-kelahiran');
    }
}
