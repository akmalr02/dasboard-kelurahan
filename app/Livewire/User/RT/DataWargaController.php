<?php

namespace App\Livewire\User\RT;

use Livewire\Component;
use App\Models\User;
use App\Models\Warga;
use App\Models\RT;
use App\Exports\FilteredWargaExport;
use App\Exports\WargaExport;
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
        // dd([
        //     'user_id_rt' => Auth::user()->id_rt,
        // ]);

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

        // dd([
        //     'User yang login' => [
        //         'id_user' => $user->id_user,
        //         'id_rt' => $user->id_rt,
        //         'id_rw' => $user->id_rw,
        //     ],
        //     'Sample Warga' => optional($sampleWarga)->only(['id_warga', 'name', 'id_RT', 'id_RW']),
        // ]);
        $query = Warga::query()
            ->where('id_RT', $user->id_rt)
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('NIK', 'like', '%' . $this->search . '%')
                    ->orWhere('NKK', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%');
            });

        // dd(Auth::user());
        // dd(Warga::first());

        // $wargas = Warga::where('id_RT', $user->id_rt)->get();
        // dd('berhasil');
        return view('livewire.user.r-t.data-warga', [
            'title' => 'Data KeluargaW',
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
