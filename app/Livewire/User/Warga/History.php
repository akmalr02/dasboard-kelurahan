<?php

namespace App\Livewire\User\Warga;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SuratPengantar;
use App\Models\SuratKelahiran;
use App\Models\SuratKematian;
use Illuminate\Support\Facades\Auth;

class History extends Component
{
    use WithPagination;

    protected string $layout = 'layouts.app';
    protected $paginationTheme = 'tailwind';

    public string $jenis = 'pengantar';
    public string $search = '';
    public bool $showDetailModal = false;
    public $selectedSurat = null;

    public function updatedJenis()
    {
        $this->search = '';
        $this->resetPage();
    }

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
        $this->selectedSurat = match ($this->jenis) {
            'pengantar' => SuratPengantar::with(['pelapor', 'warga', 'rt', 'rw'])->find($id),
            'kelahiran' => SuratKelahiran::with(['ayah', 'ibu', 'admin'])->find($id),
            'kematian' => SuratKematian::with(['pelapor', 'admin'])->find($id),
            default => null,
        };

        if ($this->selectedSurat) {
            $this->showDetailModal = true;
        }
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedSurat = null;
    }

    public function render()
    {
        $user = Auth::user();

        $idWarga = $user->warga->id_warga ?? null;

        $surats = match ($this->jenis) {
            'pengantar' => SuratPengantar::with(['pelapor.rt', 'pelapor.rw'])
                ->where('id_pengantar', $user->id_user)
                ->whereNotNull('file_ttd_rt')
                ->whereNotNull('file_ttd_rw')
                ->with(['pelapor', 'warga', 'rt', 'rw'])
                ->when($this->search, function ($query) {
                    $query->where(function ($sub) {
                        $sub->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%')
                            ->orWhereHas(
                                'warga',
                                fn($q) => $q->where('nama_warga', 'like', '%' . $this->search . '%')
                            );
                    });
                })
                ->orderByDesc('tanggal_pengajuan')
                ->paginate(10),

            'kelahiran' => SuratKelahiran::query()
                ->whereNotNull('file_ttd_admin')
                ->where(function ($query) use ($idWarga) {
                    $query->where('id_ayah', $idWarga)
                        ->orWhere('id_ibu', $idWarga);
                })
                ->with(['ayah.rt', 'ayah.rw', 'ibu'])
                ->when($this->search, function ($query) {
                    $query->where(function ($sub) {
                        $sub->where('nama_anak', 'like', '%' . $this->search . '%')
                            ->orWhereHas('ayah', fn($q) => $q->where('nama_warga', 'like', '%' . $this->search . '%'))
                            ->orWhereHas('ibu', fn($q) => $q->where('nama_warga', 'like', '%' . $this->search . '%'));
                    });
                })
                ->latest()
                ->paginate(10),

            'kematian' => SuratKematian::query()
                ->whereNotNull('file_ttd_admin')
                ->whereHas('pelapor', fn($q) => $q->where('id_warga', $idWarga))
                ->with(['pelapor', 'admin'])
                ->when($this->search, function ($query) {
                    $query->where(function ($sub) {
                        $sub->where('nama_warga', 'like', '%' . $this->search . '%')
                            ->orWhereHas(
                                'pelapor',
                                fn($q) => $q->where('nama_warga', 'like', '%' . $this->search . '%')
                            );
                    });
                })
                ->latest()
                ->paginate(10),

            default => collect()->paginate(10),
        };

        return view('livewire.user.warga.history', [
            'title' => 'Halaman History Surat',
            'surats' => $surats,
        ]);
    }
}
