<?php

namespace App\Livewire\User\RW;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public function mount() {}


    public function render()
    {
        return view('livewire.user.r-w.index', [
            'title' => 'RW Dashboard'
        ]);
    }
}
