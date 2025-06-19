<?php

namespace App\Livewire\User\RW;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public function mount() {}


    public function render()
    {
        // $user = Auth::user();

        // $rw = $user->rw;

        // if (!$rw) {
        //     abort(403, 'Anda tidak terdaftar sebagai pengelola RW.');
        // }

        // $wargas = DB::table('wargas')
        //     ->where('wargas.id_RW', $rw->id_RW)
        //     ->where('wargas.status_penduduk', 'hidup')
        //     ->orderBy('wargas.id_RT')
        //     ->get()
        //     ->groupBy('id_RT');

        // dd($wargas);

        return view('livewire.user.r-w.index', [
            'title' => 'RW Dashboard',
            // 'wargasPerRt' => $wargas
        ]);
    }
}
