<?php

namespace App\Livewire\Surat;

use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddPengantarController extends Component
{
    protected string $layout = 'layouts.app';

    public $suratPengantar = [];
    public $showModal = false;
    public $selectedSurat = null;

    public function mount()
    {
        $user = Auth::user();

        $surat = $this->suratPengantar = SuratPengantar::with('rt', 'rw')
            ->when($user->role === 'pengelola_rt', fn($q) => $q->where('id_rt', $user->id_rt))
            ->when($user->role === 'pengelola_rw', fn($q) => $q->where('id_rw', $user->id_rw))
            ->latest()
            ->get();

        // dd($surat);
    }

    public function showDetail($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        $user = Auth::user();
        if (
            ($user->role === 'pengelola_rt' && $surat->id_rt != $user->id_rt) ||
            ($user->role === 'pengelola_rw' && $surat->id_rw != $user->id_rw)
        ) {
            abort(403, 'Anda tidak berhak melihat surat ini.');
        }

        $this->selectedSurat = $surat;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
    }

    public function ttdRt($id)
    {
        $user = Auth::user();

        if ($user->role !== 'pengelola_rt') {
            session()->flash('error', 'Hanya Pengelola RT yang dapat menandatangani.');
            return;
        }

        $surat = SuratPengantar::find($id);

        if (!$surat || $surat->id_rt != $user->id_rt) {
            session()->flash('error', 'Surat tidak ditemukan atau bukan wilayah RT Anda.');
            return;
        }

        if (!$user->ttd_digital) {
            session()->flash('error', 'Tanda tangan digital belum tersedia.');
            return;
        }

        $surat->file_ttd_rt = $user->ttd_digital;
        $surat->tanggal_disetujui_rt = now();

        // Jika RW juga sudah tanda tangan, set status disetujui
        if ($surat->file_ttd_rw) {
            $surat->status = 'disetujui';
        }

        $surat->save();

        $this->selectedSurat = $surat;
        $this->mount();

        session()->flash('success', 'Berhasil ditandatangani oleh RT.');
    }

    public function ttdRw($id)
    {
        $user = Auth::user();

        if ($user->role !== 'pengelola_rw') {
            session()->flash('error', 'Hanya Pengelola RW yang dapat menandatangani.');
            return;
        }

        $surat = SuratPengantar::find($id);

        if (!$surat || $surat->id_rw != $user->id_rw) {
            session()->flash('error', 'Surat tidak ditemukan atau bukan wilayah RW Anda.');
            return;
        }

        if (!$user->ttd_digital) {
            session()->flash('error', 'Tanda tangan digital belum tersedia.');
            return;
        }

        $surat->file_ttd_rw = $user->ttd_digital;
        $surat->tanggal_disetujui_rw = now();

        // Jika RT juga sudah tanda tangan, set status disetujui
        if ($surat->file_ttd_rt) {
            $surat->status = 'disetujui';
        }

        $surat->save();

        $this->selectedSurat = $surat;
        $this->mount();

        session()->flash('success', 'Berhasil ditandatangani oleh RW.');
    }


    public function render()
    {
        // dd('pengantar');
        return view('livewire.surat.add-pengantar', [
            'title' => 'Pengajuan Surat Pengantar',
            'pengantars' => $this->suratPengantar,
        ]);
    }
}
