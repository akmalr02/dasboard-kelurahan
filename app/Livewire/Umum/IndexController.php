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
    public $dataKelahiran = [];
    public $dataKematian = [];
    public $generasi = [];
    public $perkawinan = [];
    public $agama = [];
    public $pendidikan = [];


    public function mount()
    {
        $this->localData();

        $this->dispatch('chartDataWarga', [
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
        ]);
    }

    public function localData()
    {
        //data jenis kelamin warga WNA
        $KWNA = Warga::where('kewarganegaraan', 'WNA')
            ->where('status_penduduk', 'hidup')
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->WNAData = [
            'L' => $KWNA['L'] ?? 0,
            'P' => $KWNA['P'] ?? 0,
        ];

        $this->totalWNA = Warga::where('kewarganegaraan', 'WNA')->where('status_penduduk', 'hidup')->count();

        // dd($totalWNA);

        //data jenis kelamin warga WNi
        $KWNI = Warga::where('kewarganegaraan', 'WNI')
            ->where('status_penduduk', 'hidup')
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        $this->WNIData = [
            'L' => $KWNI['L'] ?? 0,
            'P' => $KWNI['P'] ?? 0,
        ];
        $this->totalWNI = Warga::where('kewarganegaraan', 'WNI')->where('status_penduduk', 'hidup')->count();

        // dd($this->WNIData);

        //data totoal jenis kelamin
        $totalJK = Warga::selectRaw('jenis_kelamin, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
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
        //     'total WNI' => $this->totalWNI,
        //     'total WNA' => $this->totalWNA,
        //     'total warga' => $this->totalWarga
        // ];

        // dd($data);

        //data kelahiran
        $kelahiran = Warga::selectRaw('YEAR(tanggal_lahir) as tahun_lahir, jenis_kelamin, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->whereNotNull('tanggal_lahir')
            ->whereYear('tanggal_lahir', '>=', now()->year - 4)
            ->groupBy('tahun_lahir', 'jenis_kelamin')
            ->orderBy('tahun_lahir')
            ->get();

        $dataKelahiran = [];

        foreach ($kelahiran as $item) {
            $dataKelahiran[$item->tahun_lahir][$item->jenis_kelamin] = $item->total;
        }

        $this->dataKelahiran = $dataKelahiran;
        // dd($this->dataKelahiran);

        //data kematian
        $kematian = Warga::selectRaw('YEAR(tanggal_meninggal) as tahun, jenis_kelamin, COUNT(*) as total')
            ->where('status_penduduk', 'meninggal')
            ->whereNotNull('tanggal_meninggal')
            ->groupBy('tahun', 'jenis_kelamin')
            ->orderBy('tahun')
            ->get();

        $dataKematian = [];

        foreach ($kematian as $item) {
            $dataKematian[$item->tahun][$item->jenis_kelamin] = $item->total;
        }

        $this->dataKematian = $dataKematian;

        // dd($this->dataKematian);

        //data generasi
        $generasi = [
            'Pre-Boomer' => 0,
            'Baby Boomer' => 0,
            'Generasi X' => 0,
            'Generasi Y' => 0,
            'Generasi Z' => 0,
            'Generasi Alpha' => 0,
            'Generasi Beta' => 0,
        ];

        $wargas = Warga::whereNotNull('tanggal_lahir')
            ->where('status_penduduk', 'hidup')
            ->get();

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
        // dd($generasi);

        //status perkawinan
        $perkawinan = Warga::selectRaw('status_perkawinan, COUNT(*) as total')
            ->groupBy('status_perkawinan')
            ->orderBy('status_perkawinan')
            ->get()
            ->pluck('total', 'status_perkawinan')
            ->toArray();

        $this->perkawinan = $perkawinan;

        // dd($perkawinan);

        //agama
        $agama = Warga::selectRaw('agama, COUNT(*) as total')
            ->groupBy('agama')
            ->orderBy('agama')
            ->get()
            ->pluck('total', 'agama')
            ->toArray();

        $this->agama = $agama;

        // dd($agama);

        //pendidikan
        $pendidikan = Warga::selectRaw('pendidikan, COUNT(*) as total')
            ->groupBy('pendidikan')
            ->orderBy('pendidikan')
            ->get()
            ->pluck('total', 'pendidikan')
            ->toArray();

        $this->pendidikan = $pendidikan;

        // dd($pendidikan);
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
        ]);
    }
}
