<?php

namespace App\Livewire\Chart;

use Livewire\Component;

class Agama extends Component
{
    public $data = [];

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.chart.agama');
    }
}
