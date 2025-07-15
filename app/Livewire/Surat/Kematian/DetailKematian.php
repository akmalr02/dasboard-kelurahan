<?php

namespace App\Livewire\Surat\Kematian;

use Livewire\Component;
use App\Models\SuratKematian;

class DetailKematian extends Component
{
    public bool $isOpen = false;
    public $selectedSurat = null;

    protected $listeners = ['showKematianModal', 'closeModal'];

    public function showKematianModal($data)
    {
        $this->reset('selectedSurat');
        $this->isOpen = true;
        $this->selectedSurat = $data;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedSurat = null;
        $this->dispatch('modalClosed');
    }

    public function render()
    {
        return view('livewire.surat.kematian.detail-kematian');
    }
}
