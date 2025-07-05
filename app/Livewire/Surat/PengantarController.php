<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;

class PengantarController extends Component
{
    protected string $layout = 'layouts.app';

    public $showModal = false;
    public $selectedSurat = null;

    public function showDetail($id)
    {
        $surat = $this->selectedSurat = SuratPengantar::with(['rt', 'rw', 'pelapor'])->findOrFail($id);

        // dd($this->selectedSurat);
        if ($surat->id_pengantar !== Auth::user()->id_user) {
            abort(403, 'Anda tidak berhak mengakses data ini.');
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function render()
    {
        $pengantars = SuratPengantar::where('id_pengantar', Auth::user()->id_user)
            ->orderByDesc('tanggal_pengajuan')
            ->get();

        return view('livewire.surat.pengantar', [
            'title' => 'Pengajuan Surat Pengantar',
            'pengantars' => $pengantars,
        ]);
    }
}
