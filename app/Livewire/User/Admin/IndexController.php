<?php

namespace App\Livewire\User\Admin;

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

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $this->loadStats();
    }

    public function render()
    {
        return view('livewire.user.admin.index-controller', [
            'title' => 'Admin Dashboard'
        ]);
    }
}
