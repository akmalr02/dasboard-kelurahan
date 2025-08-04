<?php

namespace App\Livewire\Umum;

use Livewire\Component;
use App\Models\Warga;
use App\Models\Rw;
use App\Models\RT;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';

    public $WNAData = [];
    public $WNIData = [];
    public $totalData = [];
    public $totalWNA = 0;
    public $totalWNI = 0;
    public $totalWarga = 0;
    public $dataKelahiran = [];
    public $dataKematian = [];
    public $generasi = [];
    public $perkawinan = [];
    public $agama = [];
    public $pendidikan = [];

    public $id_RT = null;
    public $id_RW = null;
    public $availableRT = [];

    public function updatedIdRW()
    {
        $this->id_RT = null;
        $this->loadAvailableRT();
        $this->localData();
        $this->dispatchChartData();
    }

    public function updatedIdRT()
    {
        $this->loadAvailableRT();
        $this->localData();
        $this->dispatchChartData();
    }

    public function mount()
    {
        $this->localData();
        $this->dispatchChartData();
    }

    public function loadAvailableRT()
    {
        if ($this->id_RW) {
            $this->availableRT = RT::where('id_RW', $this->id_RW)->get();
        } else {
            $this->availableRT = RT::all();
        }
    }

    private function dispatchChartData()
    {
        $data = [
            'WNA' => $this->WNAData,
            'WNI' => $this->WNIData,
            'TOTAL' => $this->totalData,
            'totalWNA' => $this->totalWNA,
            'totalWNI' => $this->totalWNI,
            'totalWarga' => $this->totalWarga,
            'dataKelahiran' => $this->dataKelahiran,
            'dataKematian' => $this->dataKematian,
            'generasi' => $this->generasi,
            'perkawinan' => $this->perkawinan,
            'agama' => $this->agama,
            'pendidikan' => $this->pendidikan,
        ];

        $this->dispatch('chartDataWarga', $data);

        $this->dispatchBrowserEvent('chartDataWargaInit', $data);
    }

    public function localData()
    {
        $queryWNA = Warga::where('kewarganegaraan', 'WNA')
            ->where('status_penduduk', 'hidup');

        if ($this->id_RT) {
            $queryWNA->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $queryWNA->where('id_RW', $this->id_RW);
        }

        $this->totalWNA = $queryWNA->count();

        $KWNA = (clone $queryWNA)
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->WNAData = [
            'L' => $KWNA['L'] ?? 0,
            'P' => $KWNA['P'] ?? 0,
        ];

        $queryWNI = Warga::where('kewarganegaraan', 'WNI')
            ->where('status_penduduk', 'hidup');

        if ($this->id_RT) {
            $queryWNI->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $queryWNI->where('id_RW', $this->id_RW);
        }

        $KWNI = (clone $queryWNI)
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->WNIData = [
            'L' => $KWNI['L'] ?? 0,
            'P' => $KWNI['P'] ?? 0,
        ];

        $this->totalWNI = (clone $queryWNI)->count();

        $queryTotal = Warga::where('status_penduduk', 'hidup');

        if ($this->id_RT) {
            $queryTotal->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $queryTotal->where('id_RW', $this->id_RW);
        }

        $totalJK = (clone $queryTotal)
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->totalData = [
            'L' => $totalJK['L'] ?? 0,
            'P' => $totalJK['P'] ?? 0,
        ];

        $this->totalWarga = (clone $queryTotal)->count();

        $queryKelahiran = Warga::selectRaw('YEAR(tanggal_lahir) as tahun_lahir, jenis_kelamin, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->whereNotNull('tanggal_lahir')
            ->whereYear('tanggal_lahir', '>=', now()->year - 4);

        if ($this->id_RT) {
            $queryKelahiran->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $queryKelahiran->where('id_RW', $this->id_RW);
        }

        $kelahiran = $queryKelahiran
            ->groupBy('tahun_lahir', 'jenis_kelamin')
            ->orderBy('tahun_lahir')
            ->get();

        $dataKelahiran = [];

        foreach ($kelahiran as $item) {
            $dataKelahiran[$item->tahun_lahir][$item->jenis_kelamin] = $item->total;
        }

        $this->dataKelahiran = $dataKelahiran;

        $queryKematian = Warga::selectRaw('YEAR(tanggal_meninggal) as tahun, jenis_kelamin, COUNT(*) as total')
            ->where('status_penduduk', 'meninggal')
            ->whereNotNull('tanggal_meninggal');

        if ($this->id_RT) {
            $queryKematian->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $queryKematian->where('id_RW', $this->id_RW);
        }

        $kematian = $queryKematian
            ->groupBy('tahun', 'jenis_kelamin')
            ->orderBy('tahun')
            ->get();

        $dataKematian = [];

        foreach ($kematian as $item) {
            $dataKematian[$item->tahun][$item->jenis_kelamin] = $item->total;
        }

        $this->dataKematian = $dataKematian;

        $generasi = [
            'Pre-Boomer'     => 0,
            'Baby Boomer'    => 0,
            'Generasi X'     => 0,
            'Generasi Y'     => 0,
            'Generasi Z'     => 0,
            'Generasi Alpha' => 0,
            'Generasi Beta'  => 0,
        ];

        $query = Warga::query()
            ->whereNotNull('tanggal_lahir')
            ->where('status_penduduk', 'hidup');

        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        $wargas = $query->get();

        foreach ($wargas as $warga) {
            $tahun = date('Y', strtotime($warga->tanggal_lahir));

            if ($tahun < 1945) {
                $generasi['Pre-Boomer']++;
            } elseif ($tahun <= 1964) {
                $generasi['Baby Boomer']++;
            } elseif ($tahun <= 1980) {
                $generasi['Generasi X']++;
            } elseif ($tahun <= 1996) {
                $generasi['Generasi Y']++;
            } elseif ($tahun <= 2012) {
                $generasi['Generasi Z']++;
            } elseif ($tahun <= 2024) {
                $generasi['Generasi Alpha']++;
            } else {
                $generasi['Generasi Beta']++;
            }
        }

        $this->generasi = $generasi;

        $query = Warga::selectRaw('status_perkawinan, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->groupBy('status_perkawinan')
            ->orderBy('status_perkawinan');

        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        $perkawinan = $query->get()
            ->pluck('total', 'status_perkawinan')
            ->toArray();

        $this->perkawinan = $perkawinan;

        $query = Warga::selectRaw('agama, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->groupBy('agama')
            ->orderBy('agama');

        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        $agama = $query->get()
            ->pluck('total', 'agama')
            ->toArray();

        $this->agama = $agama;

        $query = Warga::selectRaw('pendidikan, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->groupBy('pendidikan')
            ->orderBy('pendidikan');

        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        $pendidikan = $query->get()
            ->pluck('total', 'pendidikan')
            ->toArray();

        $this->pendidikan = $pendidikan;
    }

    public function render()
    {
        return view('livewire.umum.index', [
            'title' => 'Dashboard Kependudukan - Kelurahan Kramat',
            'WNAData' => $this->WNAData,
            'WNIData' => $this->WNIData,
            'totalData' => $this->totalData,
            'dataKelahiran' => $this->dataKelahiran,
            'dataKematian' => $this->dataKematian,
            'generasi' => $this->generasi,
            'perkawinan' => $this->perkawinan,
            'agama' => $this->agama,
            'pendidikan' => $this->pendidikan,
            'rwList' => RW::all(),
            'rtList' => $this->availableRT,
        ]);
    }
}
