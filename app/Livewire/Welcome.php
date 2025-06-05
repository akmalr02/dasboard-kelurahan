<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{
    protected string $layout = 'layouts.app';

    public function render()
    {
        return view('livewire.welcome', [
            'title' => 'Kelurahan Kramat - Beranda'
        ]);
    }
}
