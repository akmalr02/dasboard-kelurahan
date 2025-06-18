<?php

namespace App\Livewire\Chart;

use Livewire\Component;

class Wni extends Component
{
    public $data = [
        'L' => 0,
        'P' => 0
    ];

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.chart.wni');
    }
}
