<?php

namespace App\Livewire\User\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public function mount() {}

    public function render()
    {
        return view('livewire.user.admin.index', [
            'title' => 'Admin Dashboard'
        ]);
    }
}
