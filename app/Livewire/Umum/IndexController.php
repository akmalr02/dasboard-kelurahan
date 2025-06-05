<?php

namespace App\Livewire\Umum;

use Livewire\Component;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public function render()
    {
        return view('livewire.umum.index', [
            'title' => 'Dashboard Kependudukan - Kelurahan Kramat'
        ]);
    }
}
