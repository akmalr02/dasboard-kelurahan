<?php

namespace App\Livewire\User\Rw;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;

class HistoryTtdSurat extends Component
{
    use WithPagination;
    protected string $layout = 'layouts.app';

    public $search = '';
    protected $listeners = ['modalClosed' => 'handleModalClosed'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }
    public function showDetail($id)
    {
        // dd('berhasil');
        $surat = SuratPengantar::with(['pelapor.rw', 'pelapor.rt'])->findOrFail($id);
        $suratArray = $surat->toArray();
        $this->dispatch('showModalSurat', $suratArray);
    }

    public function render()
    {
        $user = Auth::user();

        $surats = SuratPengantar::with('rt', 'rw')
            // ->when($user->role === 'pengelola_rt', fn($q) => $q->where('id_rt', $user->id_rt)->whereNotNull('file_ttd_rt'))
            ->when($user->role === 'pengelola_rw', fn($q) => $q->where('id_rw', $user->id_rw)->whereNotNull('file_ttd_rw'))
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('keperluan', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('tanggal_pengajuan')
            ->paginate(10);

        return view('livewire.user.r-w.history-ttd-surat', [
            'title' => 'History surat RW',
            'surats' => $surats,
        ]);
    }
}
