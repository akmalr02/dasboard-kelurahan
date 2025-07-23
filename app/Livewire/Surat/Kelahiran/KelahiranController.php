<?php

namespace App\Livewire\Surat\Kelahiran;

use Livewire\Component;
use App\Models\SuratKelahiran;
use Illuminate\Support\Facades\Auth;

class KelahiranController extends Component
{
    protected string $layout = 'layouts.app';

    public $suratKelahiran;
    public $daftarSuratKelahiran = [];
    public $showModal = false;
    public $selectedSurat = null;
    public $successMessage = null;

    protected $listeners = [
        'modalClosed' => 'handleModalClosed',
        'kelahiranUpdated' => 'loadKelahirans',
        'kelahiranDeleted' => 'loadKelahirans',
        'showSuccessMessage' => 'handleSuccessMessage',
    ];

    public function handleSuccessMessage($message)
    {
        $this->successMessage = $message;
    }

    public function showDetail($id)
    {
        $surat = $this->selectedSurat = SuratKelahiran::with(['ayah.rt.rw', 'ibu'])->findOrFail($id);
        if ($surat->id_ayah !== (Auth::user()->warga->id_warga ?? null)) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }
        $suratArray = $surat->toArray();
        $this->dispatch('showKelahiranModal', $suratArray);
    }

    public function showEdit($id)
    {
        $surat = $this->selectedSurat = SuratKelahiran::with(['ayah.rt.rw', 'ibu'])->findOrFail($id);
        if ($surat->id_ayah !== (Auth::user()->warga->id_warga ?? null)) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }
        $suratArray = $surat->toArray();
        $this->dispatch('editKelahiran', $suratArray);
    }

    public function showDelete($id)
    {
        $surat = $this->selectedSurat = SuratKelahiran::with(['ayah.rt.rw', 'ibu'])->findOrFail($id);
        if ($surat->id_ayah !== (Auth::user()->warga->id_warga ?? null)) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }
        $suratArray = $surat->toArray();
        $this->dispatch('deletKelahiran', $suratArray);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function mount()
    {
        $this->loadKelahirans();
    }

    public function loadKelahirans()
    {
        $idWarga = Auth::user()->warga->id_warga ?? null;

        $this->suratKelahiran = SuratKelahiran::with(['ayah.rt', 'ayah.rw', 'ibu'])
            ->where('id_ayah', $idWarga)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.surat.kelahiran.kelahiran', [
            'title' => 'Pengajuan surat Kelahiran',
            'suratKelahiran' =>  $this->suratKelahiran,
        ]);
    }
}
