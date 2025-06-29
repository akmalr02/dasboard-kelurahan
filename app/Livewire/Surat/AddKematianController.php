<?php

namespace App\Livewire\Surat;

use App\Models\SuratKematian;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddKematianController extends Component
{
    protected string $layout = 'layouts.app';

    public $SuratKematian = [];
    public $showModal = false;
    public $selectedSurat = null;

    public function mount()
    {
        $this->SuratKematian = SuratKematian::all();
    }

    public function showDetail($id)
    {
        $this->selectedSurat = SuratKematian::find($id);
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

        $surat = SuratKematian::find($id);

        if (!$surat) {
            session()->flash('error', 'Surat tidak ditemukan.');
            return;
        }

        $surat->update([
            'id_admin' => $admin->id_user,
            'file_ttd_admin' => $admin->ttd_digital,
        ]);

        session()->flash('success', 'Tanda tangan berhasil ditambahkan.');
        $this->mount(); // Refresh data
    }

    public function render()
    {
        // dd('kematian');

        return view('livewire.surat.add-kematian', [
            'title' => 'Pengajuan surat kematian',
            'kematians' => $this->SuratKematian
        ]);
    }
}
