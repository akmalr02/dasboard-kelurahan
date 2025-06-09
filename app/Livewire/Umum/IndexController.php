<?php

namespace App\Livewire\Umum;

use Livewire\Component;
use App\Models\Warga;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public $WNAData = [];
    public $WNIData = [];
    public $totalData = [];
    public $totalWNA = 0;
    public $totalWNI = 0;
    public $totalWarga = 0;

    public function mount()
    {
        $this->localData();

        $this->dispatch('chartDataWarga', [
            'WNA' => $this->WNAData,
            'WNI' => $this->WNIData,
            'TOTAL' => $this->totalData,
            'totalWNA' => $this->totalWNA,
            'totalWNI' => $this->totalWNI,
            'totalWarga' => $this->totalWarga
        ]);
    }

    public function localData()
    {
        $KWNA = Warga::where('kewarganegaraan', 'WNA')
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->WNAData = [
            'L' => $KWNA['L'] ?? 0,
            'P' => $KWNA['P'] ?? 0,
        ];

        $this->totalWNA = Warga::where('kewarganegaraan', 'WNA')->count();

        // dd($totalWNA);

        $KWNI = Warga::where('kewarganegaraan', 'WNI')
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->WNIData = [
            'L' => $KWNI['L'] ?? 0,
            'P' => $KWNI['P'] ?? 0,
        ];
        $this->totalWNI = Warga::where('kewarganegaraan', 'WNI')->count();

        // dd($this->WNIData);

        $totalJK = Warga::selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->totalData = [
            'L' => $totalJK['L'] ?? 0,
            'P' => $totalJK['P'] ?? 0,
        ];

        $this->totalWarga = $this->totalWNA + $this->totalWNI;
        // dd($this->totalData);

        // $data = [
        //     'jenis kelamin WNA' => $this->WNAData,
        //     'jenis kelamin WNI' => $this->WNIData,
        //     'jenis kelamin WNI+WNI' => $this->totalData,
        //     'total WNI' => $this->totalWNA,
        //     'total WNA' => $this->totalWNI,
        //     'total warga' => $this->totalWarga
        // ];

        // dd($data);
    }

    public function render()
    {
        return view('livewire.umum.index', [
            'title' => 'Dashboard Kependudukan - Kelurahan Kramat',
            'WNAData' => $this->WNAData,
            'WNIData' => $this->WNIData,
            'totalData' => $this->totalData,
        ]);
    }
}
