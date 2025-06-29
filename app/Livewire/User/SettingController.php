<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Warga;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SettingController extends Component
{
    protected string $layout = 'layouts.app';

    public $selectedWarga = null;


    public function data($id)
    {
        $this->selectedWarga = Warga::findOrFail($id);
    }

    public function render()
    {
        $user = Auth::user();

        $data = $user?->wargas;

        if ($user) {
            $data = $user->warga;
        }

        // dd($data);
        return view('livewire.user.setting', [
            'title' => 'akun saya',
            'user' => $user,
            'warga' => $data,
        ]);
    }
}
