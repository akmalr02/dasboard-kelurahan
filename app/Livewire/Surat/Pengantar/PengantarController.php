<?php

namespace App\Livewire\Surat\Pengantar;

use Livewire\Component;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;

class PengantarController extends Component
{
    protected string $layout = 'layouts.app';

    public $pengantars;
    public $showModal = false;
    public $selectedSurat = null;
    public $successMessage = null;

    protected $listeners = [
        'modalClosed' => 'handleModalClosed',
        'pengantarUpdated' => 'loadPengantars',
        'pengantarDeleted' => 'loadPengantars',
        'showSuccessMessage' => 'handleSuccessMessage',
    ];

    public function handleSuccessMessage($message)
    {
        $this->successMessage = $message;
    }

    public function mount()
    {
        $this->loadPengantars();
    }

    public function loadPengantars()
    {
        $this->pengantars = SuratPengantar::with(['pelapor.rt', 'pelapor.rw'])
            ->where('id_pengantar', Auth::user()->id_user)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function showDetail($id)
    {
        $surat = SuratPengantar::with(['pelapor.rw', 'pelapor.rt'])->findOrFail($id);
        $suratArray = $surat->toArray();
        $this->dispatch('showModalSurat', $suratArray);
    }

    public function showEdit($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        $suratArray = $surat->toArray();
        $this->dispatch('editPengantar', $suratArray);
    }

    public function showDelete($id)
    {
        $surat = SuratPengantar::findOrFail($id);

        $suratArray = $surat->toArray();
        $this->dispatch('deletPengantar', $suratArray);
    }

    public function handleModalClosed()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }
    public function render()
    {
        return view('livewire.surat.pengantar.pengantar', [
            'title' => 'Pengajuan Surat Pengantar',
            'pengantars' => $this->pengantars,
        ]);
    }
}
