<?php

namespace App\Livewire\Surat;

use App\Models\Warga;
use Livewire\Component;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Auth;

class CreatePengantarController extends Component
{
    protected string $layout = 'layouts.app';

    public string $nama = '';
    public string $NIK = '';
    public string $NKK = '';
    public string $jenis_kelamin = '';
    public string $tempat_lahir = '';
    public $tanggal_lahir;
    public string $status_perkawinan = '';
    public string $kewarganegaraan = '';
    public string $agama = '';
    public string $pekerjaan = '';
    public string $alamat = '';
    public string $keperluan = '';
    public string $email = '';

    protected array $rules = [
        'nama' => 'required|string|max:225',
        'NIK' => 'required|numeric|digits_between:8,20|unique:surat_pengantars,NIK',
        'NKK' => 'required|numeric|digits_between:8,20',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'nullable|string|max:100',
        'tanggal_lahir' => 'nullable|date',
        'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
        'kewarganegaraan' => 'required|in:WNI,WNA',
        'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu,Lainnya',
        'pekerjaan' => 'nullable|string|max:100',
        'alamat' => 'nullable|string|max:225',
        'keperluan' => 'required|string|not_regex:/<script\b[^>]*>(.*?)<\/script>/i',
        'email' => 'required|email|max:225',
    ];

    protected array $messages = [
        'nama.required' => 'Nama wajib diisi.',
        'nama.max' => 'Nama tidak boleh lebih dari 225 karakter.',
        'NIK.required' => 'NIK wajib diisi.',
        'NIK.numeric' => 'NIK harus berupa angka.',
        'NIK.digits_between' => 'NIK harus antara 8 sampai 20 digit.',
        'NIK.unique' => 'NIK sudah digunakan untuk pengajuan surat.',
        'NKK.required' => 'NKK wajib diisi.',
        'NKK.numeric' => 'NKK harus berupa angka.',
        'NKK.digits_between' => 'NKK harus antara 8 sampai 20 digit.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
        'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 100 karakter.',
        'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
        'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
        'status_perkawinan.in' => 'Status perkawinan tidak valid.',
        'kewarganegaraan.required' => 'Kewarganegaraan wajib dipilih.',
        'kewarganegaraan.in' => 'Kewarganegaraan tidak valid.',
        'agama.required' => 'Agama wajib dipilih.',
        'agama.in' => 'Agama tidak valid.',
        'pekerjaan.max' => 'Pekerjaan tidak boleh lebih dari 100 karakter.',
        'alamat.max' => 'Alamat tidak boleh lebih dari 225 karakter.',
        'keperluan.required' => 'Keperluan wajib diisi.',
        'keperluan.not_regex' => 'Input keperluan mengandung tag yang tidak diizinkan.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 225 karakter.',
    ];


    public function mount()
    {
        $warga = Auth::user()->warga;

        $this->NIK = $warga->NIK ?? '';
        $this->NKK = $warga->NKK ?? '';
    }


    public function create()
    {
        $this->validate();

        $this->keperluan = strip_tags($this->keperluan);

        $warga = Auth::user()->warga;
        // dd([
        //     'id_pengantar' => Auth::user()->id_user,
        //     'nama' => $this->nama,
        //     'NIK' => $this->NIK,
        //     'NKK' => $this->NKK,
        //     'jenis_kelamin' => $this->jenis_kelamin,
        //     'tempat_lahir' => $this->tempat_lahir,
        //     'tanggal_lahir' => $this->tanggal_lahir,
        //     'status_perkawinan' => $this->status_perkawinan,
        //     'kewarganegaraan' => $this->kewarganegaraan,
        //     'agama' => $this->agama,
        //     'pekerjaan' => $this->pekerjaan,
        //     'alamat' => $this->alamat,
        //     'keperluan' => $this->keperluan,
        //     'email' => $this->email,
        //     'status' => 'diproses',
        //     'tanggal_pengajuan' => now(),
        //     'id_rt' => Auth::user()->warga->id_RT ?? null,
        //     'id_rw' => Auth::user()->warga->id_RW ?? null,
        //     'kode_verifikasi' => $this->generateKodeVerifikasi($warga),
        // ]);

        SuratPengantar::create([
            'id_pengantar' => Auth::user()->id_user,
            'nama' => $this->nama,
            'NIK' => $this->NIK,
            'NKK' => $this->NKK,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'status_perkawinan' => $this->status_perkawinan,
            'kewarganegaraan' => $this->kewarganegaraan,
            'agama' => $this->agama,
            'pekerjaan' => $this->pekerjaan,
            'alamat' => $this->alamat,
            'keperluan' => $this->keperluan,
            'email' => $this->email,
            'status' => 'diproses',
            'tanggal_pengajuan' => now(),
            'id_rt' => Auth::user()->warga->id_RT ?? null,
            'id_rw' => Auth::user()->warga->id_RW ?? null,
            'kode_verifikasi' => $this->generateKodeVerifikasi($warga),
        ]);

        session()->flash('success', 'Surat pengantar berhasil diajukan.');
        return redirect()->route('create.pengantar');
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

    public function render()
    {
        return view('livewire.surat.create-pengantar');
    }
}
