<?php

namespace App\Livewire\User\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SuratPengantar;
use App\Models\SuratKelahiran;
use App\Models\SuratKematian;

class HistoriSurat extends Component
{
    use WithPagination;

    protected string $layout = 'layouts.app';
    protected $paginationTheme = 'tailwind';

    public $jenis = 'pengantar'; // default
    public $search = '';
    public $showDetailModal = false;
    public $selectedSurat = null;

    // Method untuk clear search
    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage(); // Reset pagination ketika search dibersihkan
    }

    // Method untuk update search dan reset pagination
    public function updatedSearch()
    {
        $this->resetPage(); // Reset ke halaman 1 ketika search berubah
    }

    // Method untuk ganti jenis surat
    public function updatedJenis()
    {
        $this->search = ''; // Reset search ketika ganti jenis
        $this->resetPage(); // Reset pagination ketika ganti jenis
    }

    public function showDetail($id)
    {
        if ($this->jenis === 'pengantar') {
            $this->selectedSurat = SuratPengantar::where('id_pengantar', $id)->first();
        } elseif ($this->jenis === 'kelahiran') {
            $this->selectedSurat = SuratKelahiran::where('id_kelahiran', $id)->first();
        } elseif ($this->jenis === 'kematian') {
            $this->selectedSurat = SuratKematian::where('id_kematian', $id)->first();
        }

        if ($this->selectedSurat) {
            $this->showDetailModal = true;
        }
    }


    // Method untuk menutup modal detail
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedSurat = null;
    }

    public function render()
    {
        $data = collect(); // Default empty collection

        if ($this->jenis === 'pengantar') {
            $data = SuratPengantar::query()
                ->where(function ($q) {
                    $q->whereNotNull('file_ttd_rt')->orWhereNotNull('file_ttd_rw');
                })
                ->when(
                    $this->search,
                    fn($q) => $q->where('nama', 'like', '%' . $this->search . '%')
                )
                ->latest('tanggal_pengajuan')
                ->paginate(10);
        } elseif ($this->jenis === 'kelahiran') {
            $data = SuratKelahiran::query()
                ->whereNotNull('file_ttd_admin')
                ->when(
                    $this->search,
                    fn($q) => $q->where('nama_anak', 'like', '%' . $this->search . '%')
                )
                ->latest()
                ->paginate(10);
        } elseif ($this->jenis === 'kematian') {
            $data = SuratKematian::query()
                ->whereNotNull('file_ttd_admin')
                ->when(
                    $this->search,
                    fn($q) => $q->where('nama_warga', 'like', '%' . $this->search . '%')
                )
                ->latest()
                ->paginate(10);
        }

        return view('livewire.user.admin.histori-surat', [
            'title' => 'Halaman History Surat',
            'surats' => $data
        ]);
    }
}
