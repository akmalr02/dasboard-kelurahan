<?php

namespace App\Livewire\Surat\Pengantar;

use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddPengantarController extends Component
{
    protected string $layout = 'layouts.app';

    public $suratPengantar = [];
    public $showModal = false;
    public $selectedSurat = null;
    public $statusSurat = '';

    public function mount()
    {
        $user = Auth::user();

        if (!in_array($user->role, ['pengelola_rt', 'pengelola_rw'])) {
            session()->flash('error', 'Anda tidak memiliki akses.');
            return $this->redirectRoute('error.page');
        }

        $surat = $this->suratPengantar = SuratPengantar::with('rt', 'rw')
            ->when($user->role === 'pengelola_rt', fn($q) => $q->where('id_rt', $user->id_rt))
            ->when($user->role === 'pengelola_rw', fn($q) => $q->where('id_rw', $user->id_rw))
            ->latest()
            ->get();
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
        $this->statusSurat = $surat->status;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSurat = null;
        $this->statusSurat = '';
    }

    public function updateStatus($id)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['pengelola_rw', 'pengelola_rt'])) {
            session()->flash('error', 'Anda tidak memiliki hak akses untuk mengubah status.');
            return;
        }

        $surat = SuratPengantar::find($id);

        if (!$surat) {
            session()->flash('error', 'Surat tidak ditemukan.');
            return;
        }

        if (
            ($user->role === 'pengelola_rt' && $surat->id_rt != $user->id_rt) ||
            ($user->role === 'pengelola_rw' && $surat->id_rw != $user->id_rw)
        ) {
            session()->flash('error', 'Anda tidak berhak mengubah status surat ini.');
            return;
        }

        $surat->status = $this->statusSurat;

        if ($this->statusSurat === 'disetujui') {
            if ($user->role === 'pengelola_rt') {
                $surat->tanggal_disetujui_rt = now();
            } elseif ($user->role === 'pengelola_rw') {
                $surat->tanggal_disetujui_rw = now();
            }
        }

        $surat->save();

        $this->selectedSurat = $surat;
        $this->mount();

        session()->flash('success', 'Status surat berhasil diperbarui.');
    }

    public function submitStatusChange()
    {
        if (!$this->selectedSurat) {
            session()->flash('error', 'Tidak ada surat yang dipilih.');
            return;
        }

        $this->updateStatus($this->selectedSurat->id_pengajuan);
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
        return view('livewire.surat.pengantar.add-pengantar', [
            'title' => 'Pengajuan Surat Pengantar',
            'pengantars' => $this->suratPengantar,
        ]);
    }
}
