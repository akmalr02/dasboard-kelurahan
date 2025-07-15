<?php

namespace App\Livewire\Surat\Kematian;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratKematian;
use Carbon\Carbon;

class KematianController extends Component
{
    protected string $layout = 'layouts.app';

    public $dataKematian;
    public $successMessage = null;
    public $showModal = false;
    public $selectedSurat = null;

    protected $listeners = [
        'modalClosed' => 'handleModalClosed',
        'kematianUpdated' => 'loadKematians',
        'kematianDeleted' => 'loadKematians',
        'showSuccessMessage' => 'handleSuccessMessage',
    ];

    public function handleSuccessMessage($message)
    {
        $this->successMessage = $message;
    }

    public function showDetail($id)
    {
        $surat = SuratKematian::with(['pelapor.rt', 'pelapor.rw'])->findOrFail($id);
        $suratArray = $surat->toArray();
        $this->dispatch('showKematianModal', $suratArray);
    }

    public function showEdit($id)
    {
        $surat = SuratKematian::findOrFail($id);
        // dd($surat);
        $surat->jam_meninggal = Carbon::parse($surat->jam_meninggal)->format('H:i');

        $suratArray = $surat->toArray();
        $this->dispatch('editKematian', $suratArray);
    }

    public function showDelete($id)
    {
        $surat = SuratKematian::findOrFail($id);
        // dd($surat);
        $suratArray = $surat->toArray();
        $this->dispatch('deletKematian', $suratArray);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function mount()
    {
        $this->loadKematians();
    }

    public function loadKematians()
    {
        $idWarga = Auth::user()->warga->id_warga ?? null;

        $this->dataKematian = SuratKematian::with(['pelapor'])
            ->where('id_pelapor', $idWarga)
            ->latest()
            ->get();

        // dd($this->dataKematian);
    }

    public function render()
    {
        // dd('berhasil kematian');
        return view('livewire.surat.kematian.kematian', [
            'title' => 'Pengajuan surat kematian',
            'kematianList' => $this->dataKematian
        ]);
    }
}
