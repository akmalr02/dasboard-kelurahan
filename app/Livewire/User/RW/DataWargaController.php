<?php

namespace App\Livewire\User\RW;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Warga;
use App\Models\Rt;
use App\Exports\FilteredWargaExport;
use App\Exports\WargaExport;
use Maatwebsite\Excel\Facades\Excel;

class DataWargaController extends Component
{
    use WithPagination;

    protected string $layout = 'layouts.app';
    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $selectedRT = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function downloadData($tipe)
    {
        $user = Auth::user();

        if ($tipe === 'semua') {
            return Excel::download(
                new FilteredWargaExport('rw', $user->id_rw),
                'data_warga_rw_' . $user->id_rw . '.xlsx'
            );
        }

        if ($tipe === 'warga_rt') {
            $this->validate([
                'selectedRT' => 'required|exists:rts,id_RT',
            ]);

            return Excel::download(
                new FilteredWargaExport('rt_with_id', $this->selectedRT),
                'data_warga_rw_' . $user->id_rw . '_rt_' . $this->selectedRT . '.xlsx'
            );
        }

        session()->flash('error', 'Pilihan tidak valid.');
        return null;
    }

    public function render()
    {
        $user = Auth::user();

        $query = Warga::query()
            ->where('id_RW', $user->id_rw)
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('NIK', 'like', '%' . $this->search . '%')
                    ->orWhere('NKK', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%');
            });
        $noRW = $user->rw->no_RW ?? 'RW Tidak Diketahui';


        return view('livewire.user.r-w.data-warga', [
            'title' => 'Data Warga RW ' . $noRW,
            'wargas' => $query
                ->orderBy('id_RW')
                ->orderBy('id_RT')
                ->orderBy('NKK')
                ->orderBy('NIK')
                ->orderBy('name')
                ->paginate(20),

            'rts' => RT::where('id_RW', $user->id_rw)->orderBy('no_RT')->get(),
        ]);
    }
}
