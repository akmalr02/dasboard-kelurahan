<?php

namespace App\Livewire\User\Warga;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public $userProfile = null;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'warga') {
            abort(403, 'Unauthorized');
        }

        $this->loadUserProfile();
    }

    public function loadUserProfile()
    {
        try {
            $this->userProfile = Auth::user();
        } catch (\Exception $e) {
            $this->userProfile = null;
        }
    }

    public function refreshProfile()
    {
        $this->loadUserProfile();
        session()->flash('message', 'Profil berhasil direfresh!');
    }

    public function render()
    {
        return view('livewire.user.warga.index');
    }
}
