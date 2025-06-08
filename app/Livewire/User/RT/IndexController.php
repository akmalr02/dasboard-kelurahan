<?php

namespace App\Livewire\User\RT;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public function mount() {}


    public function render()
    {
        return view('livewire.user.r-t.index', [
            'title' => 'RT Dashboard'
        ]);
    }
}
