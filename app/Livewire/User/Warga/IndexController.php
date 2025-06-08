<?php

namespace App\Livewire\User\Warga;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public $userProfile = null;

    public function mount() {}

    public function render()
    {
        return view('livewire.user.warga.index', [
            'title' => 'Warga Dashboard'
        ]);
    }
}
