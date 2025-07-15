<?php

namespace App\Livewire\Surat\Pengantar;

use Livewire\Component;

class DetailPengantar extends Component
{
    public bool $isOpen = false;
    public $surat = null;

    protected $listeners = ['showModalSurat', 'closeModal'];

    public function showModalSurat($data)
    {
        $this->reset('surat');
        $this->isOpen = true;
        $this->surat = $data;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->surat = null;
        $this->dispatch('modalClosed');
    }

    public function render()
    {
        return view('livewire.surat.pengantar.detail-pengantar');
    }
}
