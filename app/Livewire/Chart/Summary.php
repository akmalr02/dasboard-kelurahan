<?php

namespace App\Livewire\Chart;

use Livewire\Component;

class Summary extends Component
{
    public $data = [
        'totalWNA' => 0,
        'totalWNI' => 0,
        'total' => 0,
    ];

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.chart.summary');
    }
}
