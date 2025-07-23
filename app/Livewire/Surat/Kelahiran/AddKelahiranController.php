<?php

namespace App\Livewire\Surat\Kelahiran;

use App\Models\SuratKelahiran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddKelahiranController extends Component
{
    protected string $layout = 'layouts.app';

    public $SuratKelahiran = [];
    public $showModal = false;
    public $selectedSurat = null;

    public function mount()
    {
        $this->SuratKelahiran = SuratKelahiran::all();
    }

    public function showDetail($id)
    {
        $this->selectedSurat = SuratKelahiran::find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function isiTtdAdmin($id)
    {
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            session()->flash('error', 'Hanya admin yang dapat menandatangani.');
            return;
        }

        $surat = SuratKelahiran::find($id);

        if (!$surat) {
            session()->flash('error', 'Surat tidak ditemukan.');
            return;
        }

        $surat->update([
            'id_admin' => $admin->id_user,
            'file_ttd_admin' => $admin->ttd_digital,
        ]);

        session()->flash('success', 'Tanda tangan berhasil ditambahkan.');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.surat.kelahiran.add-kelahiran', [
            'title' => 'Pengajuan surat kelahiran',
            'kelahirans' => $this->SuratKelahiran
        ]);
    }
}
