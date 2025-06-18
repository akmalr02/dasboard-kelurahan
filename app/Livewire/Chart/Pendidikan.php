<?php

namespace App\Livewire\Chart;

use Livewire\Component;

class Pendidikan extends Component
{
    public $data = [];

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.chart.pendidikan');
    }
}
