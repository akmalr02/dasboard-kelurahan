<?php

namespace App\Livewire\Umum;

use Livewire\Component;
use App\Models\Warga;
use App\Models\RW;
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
        // Reset RT when RW changes
        $this->id_RT = null;
        $this->loadAvailableRT();
        $this->localData();
        $this->dispatchChartData();
    }

    public function updatedIdRT()
    {
        $this->localData();
        $this->dispatchChartData();
    }

    public function mount()
    {
        $this->loadAvailableRT();
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
        $queryWNA = Warga::where('kewarganegaraan', 'WNA')
            ->where('status_penduduk', 'hidup');

        if ($this->id_RT) {
            $queryWNA->where('id_RT', $this->id_RT);
        }

        if ($this->id_RW) {
            $queryWNA->where('id_RW', $this->id_RW);
        }

        // Total WNA berdasarkan filter RT/RW
        $this->totalWNA = $queryWNA->count();

        // Data jenis kelamin WNA berdasarkan filter RT/RW
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

        //data jenis kelamin warga WNI
        $queryWNI = Warga::where('kewarganegaraan', 'WNI')
            ->where('status_penduduk', 'hidup');

        // Tambahkan filter RT jika dipilih
        if ($this->id_RT) {
            $queryWNI->where('id_RT', $this->id_RT);
        }

        // Tambahkan filter RW jika dipilih
        if ($this->id_RW) {
            $queryWNI->where('id_RW', $this->id_RW);
        }

        // Hitung per jenis kelamin
        $KWNI = (clone $queryWNI)
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        // Simpan ke properti
        $this->WNIData = [
            'L' => $KWNI['L'] ?? 0,
            'P' => $KWNI['P'] ?? 0,
        ];

        // Hitung total seluruh WNI
        $this->totalWNI = (clone $queryWNI)->count();

        //data total jenis kelamin
        // Query dasar: warga hidup
        $queryTotal = Warga::where('status_penduduk', 'hidup');

        // Tambahkan filter RT
        if ($this->id_RT) {
            $queryTotal->where('id_RT', $this->id_RT);
        }

        // Tambahkan filter RW
        if ($this->id_RW) {
            $queryTotal->where('id_RW', $this->id_RW);
        }

        // Hitung total jenis kelamin
        $totalJK = (clone $queryTotal)
            ->selectRaw('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        // Simpan ke variabel Livewire
        $this->totalData = [
            'L' => $totalJK['L'] ?? 0,
            'P' => $totalJK['P'] ?? 0,
        ];

        // Total seluruh warga hidup
        $this->totalWarga = (clone $queryTotal)->count();

        //data kelahiran
        // Query dasar kelahiran
        $queryKelahiran = Warga::selectRaw('YEAR(tanggal_lahir) as tahun_lahir, jenis_kelamin, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->whereNotNull('tanggal_lahir')
            ->whereYear('tanggal_lahir', '>=', now()->year - 4);

        // Tambahkan filter RT
        if ($this->id_RT) {
            $queryKelahiran->where('id_RT', $this->id_RT);
        }

        // Tambahkan filter RW
        if ($this->id_RW) {
            $queryKelahiran->where('id_RW', $this->id_RW);
        }

        // Eksekusi query
        $kelahiran = $queryKelahiran
            ->groupBy('tahun_lahir', 'jenis_kelamin')
            ->orderBy('tahun_lahir')
            ->get();

        // Bentuk ulang data agar mudah digunakan di grafik atau tampilan
        $dataKelahiran = [];

        foreach ($kelahiran as $item) {
            $dataKelahiran[$item->tahun_lahir][$item->jenis_kelamin] = $item->total;
        }

        // Simpan ke property Livewire
        $this->dataKelahiran = $dataKelahiran;

        //data kematian
        // Query builder dasar
        $queryKematian = Warga::selectRaw('YEAR(tanggal_meninggal) as tahun, jenis_kelamin, COUNT(*) as total')
            ->where('status_penduduk', 'meninggal')
            ->whereNotNull('tanggal_meninggal');

        // Filter RT jika dipilih
        if ($this->id_RT) {
            $queryKematian->where('id_RT', $this->id_RT);
        }

        // Filter RW jika dipilih
        if ($this->id_RW) {
            $queryKematian->where('id_RW', $this->id_RW);
        }

        // Eksekusi query
        $kematian = $queryKematian
            ->groupBy('tahun', 'jenis_kelamin')
            ->orderBy('tahun')
            ->get();

        // Format data untuk frontend
        $dataKematian = [];

        foreach ($kematian as $item) {
            $dataKematian[$item->tahun][$item->jenis_kelamin] = $item->total;
        }

        // Simpan ke Livewire property
        $this->dataKematian = $dataKematian;

        //data generasi
        $generasi = [
            'Pre-Boomer'     => 0,
            'Baby Boomer'    => 0,
            'Generasi X'     => 0,
            'Generasi Y'     => 0,
            'Generasi Z'     => 0,
            'Generasi Alpha' => 0,
            'Generasi Beta'  => 0,
        ];

        // Gunakan query builder
        $query = Warga::query()
            ->whereNotNull('tanggal_lahir')
            ->where('status_penduduk', 'hidup');

        // Tambahkan filter RT jika ada
        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        // Tambahkan filter RW jika ada
        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        // Ambil datanya
        $wargas = $query->get();

        // Proses pengelompokan berdasarkan generasi
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

        // Simpan hasil ke properti Livewire
        $this->generasi = $generasi;

        //status perkawinan
        $query = Warga::selectRaw('status_perkawinan, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->groupBy('status_perkawinan')
            ->orderBy('status_perkawinan');

        // Tambahkan filter RT jika tersedia
        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        // Tambahkan filter RW jika tersedia
        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        // Eksekusi query dan ubah hasil ke array
        $perkawinan = $query->get()
            ->pluck('total', 'status_perkawinan')
            ->toArray();

        // Simpan ke property Livewire
        $this->perkawinan = $perkawinan;

        //agama
        $query = Warga::selectRaw('agama, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->groupBy('agama')
            ->orderBy('agama');

        // Tambahkan filter RT jika ada
        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        // Tambahkan filter RW jika ada
        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        // Eksekusi query
        $agama = $query->get()
            ->pluck('total', 'agama')
            ->toArray();

        // Simpan ke properti Livewire
        $this->agama = $agama;

        //pendidikan
        $query = Warga::selectRaw('pendidikan, COUNT(*) as total')
            ->where('status_penduduk', 'hidup')
            ->groupBy('pendidikan')
            ->orderBy('pendidikan');

        // Filter berdasarkan RT
        if ($this->id_RT) {
            $query->where('id_RT', $this->id_RT);
        }

        // Filter berdasarkan RW
        if ($this->id_RW) {
            $query->where('id_RW', $this->id_RW);
        }

        // Eksekusi dan simpan ke properti
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
