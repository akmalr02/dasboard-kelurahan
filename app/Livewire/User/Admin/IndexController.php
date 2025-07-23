<?php

namespace App\Livewire\User\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warga;
use App\Models\RW;
use App\Models\RT;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WargaExport;
use App\Exports\FilteredWargaExport;



class IndexController extends Component
{
    use WithPagination;

    protected string $layout = 'layouts.app';
    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $selectedRW = null;
    public $selectedRT = null;

    public function downloadData($tipe)
    {
        if ($tipe === 'semua') {
            return Excel::download(new WargaExport, 'seluruh data warga.xlsx');
        }

        if ($tipe === 'warga_rw' && $this->selectedRW) {
            return Excel::download(
                new FilteredWargaExport('rw', $this->selectedRW),
                "data-warga-rw-{$this->selectedRW}.xlsx"
            );
        }

        if ($tipe === 'warga_rt' && $this->selectedRT) {
            $rtData = RT::where('no_RT', $this->selectedRT)->first();

            if ($this->selectedRW) {
                $rt = RT::where('no_RT', $this->selectedRT)
                    ->where('id_RW', $this->selectedRW)
                    ->first();

                if ($rt) {
                    return Excel::download(
                        new FilteredWargaExport('rt_with_id', $rt->id_RT),
                        "data-warga-rw-{$this->selectedRW}-rt-{$this->selectedRT}.xlsx"
                    );
                }
            }

            return Excel::download(
                new FilteredWargaExport('rt', $this->selectedRT),
                "data-warga-rt-{$this->selectedRT}.xlsx"
            );
        }

        session()->flash('error', 'Harap pilih RT atau RW terlebih dahulu.');
    }

    public function exportFiltered()
    {
        $tipe = null;
        $nilai = null;

        if ($this->selectedRT) {
            $tipe = 'rt';
            $nilai = $this->selectedRT;
        } elseif ($this->selectedRW) {
            $tipe = 'rw';
            $nilai = $this->selectedRW;
        }

        if ($tipe && $nilai) {
            return Excel::download(new FilteredWargaExport($tipe, $nilai), "data-warga-{$tipe}-{$nilai}.xlsx");
        }

        session()->flash('error', 'Silakan pilih RW atau RT terlebih dahulu.');
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

    public function render()
    {
        $query = Warga::query();

        if (!empty(trim($this->search))) {
            $searchTerm = trim($this->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('NIK', 'like', '%' . $searchTerm . '%')
                    ->orWhere('NKK', 'like', '%' . $searchTerm . '%');
            });
        }

        return view('livewire.user.admin.index', [
            'title' => 'Admin Dashboard',
            'warga' => $query
                ->orderBy('id_RW')
                ->orderBy('id_RT')
                ->orderBy('NKK')
                ->orderBy('NIK')
                ->orderBy('name')
                ->paginate(20),
        ]);
    }
}
