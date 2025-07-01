<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Warga;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SettingController extends Component
{
    public function render()
    {
        $user = Auth::user();
        $warga = $user?->warga;

        return view('livewire.user.setting', [
            'title' => 'Pengaturan Akun',
            'user' => $user,
            'warga' => $warga,
        ]);
    }
}
