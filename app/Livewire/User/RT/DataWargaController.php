<?php

namespace App\Livewire\User\RT;

use Livewire\Component;
use App\Models\Warga;
use App\Models\Rt;
use App\Exports\FilteredWargaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;



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

    public function downloadDataRT()
    {
        $user = Auth::user();

        return Excel::download(
            new FilteredWargaExport('rt_with_id', $user->id_rt),
            'data_warga_rt_' . $user->id_rt . '.xlsx'
        );
    }

    public function render()
    {
        $user = Auth::user();

        $sampleWarga = Warga::where('id_RT', $user->id_rt)
            ->where('id_RW', $user->id_rw)
            ->first();

        $query = Warga::query()
            ->where('id_RT', $user->id_rt)
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('NIK', 'like', '%' . $this->search . '%')
                    ->orWhere('NKK', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%');
            });
        $noRW = $user->rw->no_RW ?? 'RW Tidak Diketahui';
        $noRT = $user->rt->no_RT ?? 'RW Tidak Diketahui';

        return view('livewire.user.r-t.data-warga', [
            'title' => 'Data Warga RW ' . $noRW . '/' . 'RT ' . $noRT,
            'wargas' => $query
                ->orderBy('id_RW')
                ->orderBy('id_RT')
                ->orderBy('NKK')
                ->orderBy('NIK')
                ->orderBy('name')
                ->paginate(20),

            'rts' => RT::where('id_RT', $user->id_rt)->get(),
        ]);
    }
}
