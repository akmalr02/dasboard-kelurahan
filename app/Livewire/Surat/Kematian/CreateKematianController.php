<?php

namespace App\Livewire\Surat\Kematian;

use Livewire\Component;
use App\Models\SuratKematian;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;

class CreateKematianController extends Component
{
    protected string $layout = 'layouts.app';

    public $nama_warga, $tempat_lahir, $tanggal_lahir;
    public $jenis_kelamin, $agama, $alamat;
    public $hari_meninggal, $tanggal_meninggal, $jam_meninggal;
    public $penyebab, $tempat_pemakaman;

    protected $rules = [
        'nama_warga' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:100',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'agama' => 'required',
        'alamat' => 'required|string|max:255',
        'hari_meninggal' => 'required|string|max:20',
        'tanggal_meninggal' => 'required|date',
        'jam_meninggal' => 'required|date_format:H:i',
        'penyebab' => 'nullable|string|max:255',
        'tempat_pemakaman' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'nama_warga.required' => 'Nama warga wajib diisi.',
        'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'agama.required' => 'Agama wajib dipilih.',
        'alamat.required' => 'Alamat wajib diisi.',
        'hari_meninggal.required' => 'Hari meninggal wajib diisi.',
        'tanggal_meninggal.required' => 'Tanggal meninggal wajib diisi.',
        'jam_meninggal.required' => 'Jam meninggal wajib diisi.',
        'penyebab.max' => 'Penyebab maksimal 255 karakter.',
        'penyebab.not_regex' => 'Input penyebab mengandung tag yang tidak diizinkan.',
        'tempat_pemakaman.max' => 'Tempat pemakaman maksimal 255 karakter.',
        'tempat_pemakaman.not_regex' => 'Input tempat pemakaman mengandung tag yang tidak diizinkan.',
    ];


    public function mount()
    {
        $user = Auth::user();

        if (!$user->warga) {
            abort(403, 'Anda tidak terdaftar sebagai warga.');
        }

        // dd($user);
    }

    public function render()
    {
        return view('livewire.surat.kematian.create-kematian');
    }

    public function create()
    {
        $this->validate();

        // dd($this->validate());

        $user = Auth::user();
        $warga = $user->warga;

        if (!$warga) {
            session()->flash('error', 'Data warga tidak ditemukan.');
            return;
        }

        $this->penyebab = strip_tags($this->penyebab);
        $this->tempat_pemakaman = strip_tags($this->tempat_pemakaman);

        SuratKematian::create([
            'id_pelapor' => $warga->id_warga,
            'nama_warga' => $this->nama_warga,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama' => $this->agama,
            'alamat' => $this->alamat,
            'hari_meninggal' => $this->hari_meninggal,
            'tanggal_meninggal' => $this->tanggal_meninggal,
            'jam_meninggal' => $this->jam_meninggal,
            'penyebab' => $this->penyebab,
            'tempat_pemakaman' => $this->tempat_pemakaman,
            'kode_verifikasi' => $this->generateKodeVerifikasi($warga),
        ]);

        session()->flash('success', 'Surat kematian berhasil dibuat.');
        return redirect()->route('create.kematian');
    }

    private function generateKodeVerifikasi(Warga $warga)
    {
        $kodeKelurahan = '10450';
        $rt = str_pad(optional($warga->rt)->no_RT ?? 0, 2, '0', STR_PAD_LEFT);
        $rw = str_pad(optional($warga->rw)->no_RW ?? 0, 2, '0', STR_PAD_LEFT);

        $tanggal = now();
        $dd = $tanggal->format('d');
        $mm = $tanggal->format('m');
        $yyyy = $tanggal->format('Y');

        $random = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return "{$kodeKelurahan}{$rt}{$rw}{$dd}{$mm}{$yyyy}{$random}";
    }
}
