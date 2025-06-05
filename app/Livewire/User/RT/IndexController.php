<?php

namespace App\Livewire\User\RT;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Sesuaikan dengan role yang digunakan di AuthController
        if (!in_array(Auth::user()->role, ['rt', 'pengelola_rt'])) {
            abort(403, 'Unauthorized');
        }

        $this->loadStats();
    }


    public function render()
    {
        return view('livewire.user.r-t.index');
    }
}
