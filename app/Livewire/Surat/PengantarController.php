<?php

namespace App\Livewire\Surat;

use Livewire\Component;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;

class PengantarController extends Component
{
    protected string $layout = 'layouts.app';

    public function render()
    {
        $pengantars = SuratPengantar::where('id_pengantar', Auth::user()->id_user)
            ->latest()
            ->get();

        return view('livewire.surat.pengantar', [
            'pengantars' => $pengantars,
        ]);
    }
}
