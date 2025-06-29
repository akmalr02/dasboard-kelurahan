<?php

namespace App\Livewire\Surat;

use App\Models\Warga;
use Livewire\Component;
use App\Models\SuratKelahiran;
use Illuminate\Support\Facades\Auth;

class CreateKelahiranController extends Component
{
    protected string $layout = 'layouts.app';

    public $nama_anak, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $hari_lahir;
    public $id_ibu, $id_ayah;
    public $anggotaKeluarga = [];

    public function rules()
    {
        return [
            'nama_anak' => 'required|string|max:225',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'hari_lahir' => 'required|string|max:20',
            'id_ibu' => 'required|exists:wargas,id_warga',
            'id_ayah' => 'required|exists:wargas,id_warga',
        ];
    }

    protected $messages = [
        'nama_anak.required' => 'Nama anak wajib diisi.',
        'nama_anak.max' => 'Nama anak maksimal 225 karakter.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
        'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
        'tempat_lahir.max' => 'Tempat lahir maksimal 100 karakter.',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        'hari_lahir.required' => 'Hari lahir wajib diisi.',
        'id_ibu.required' => 'Ibu wajib dipilih.',
        'id_ibu.exists' => 'Data ibu tidak ditemukan.',
        'id_ayah.required' => 'Ayah wajib dipilih.',
        'id_ayah.exists' => 'Data ayah tidak ditemukan.',
    ];

    public function mount()
    {
        $user = Auth::user();

        if ($user->warga && $user->warga->NKK) {
            $this->anggotaKeluarga = Warga::where('NKK', $user->warga->NKK)
                ->where('status_penduduk', 'hidup')
                ->get();
        }
        // dd('angota keluarga', $this->anggotaKeluarga);
    }

    public function render()
    {
        return view('livewire.surat.create-kelahiran', [
            'anggotaKeluarga' => $this->anggotaKeluarga
        ]);
    }

    public function store()
    {
        $this->validate();

        // dd($this->validate());

        $code  = Warga::with(['rt', 'rw'])->findOrFail($this->id_ayah);
        // dd($ayah->toArray());


        // $kodeKelurahan = '10450';
        // $rt = str_pad(optional($ayah->rt)->no_RT ?? 0, 2, '0', STR_PAD_LEFT);
        // $rw = str_pad(optional($ayah->rw)->no_RW ?? 0, 2, '0', STR_PAD_LEFT);
        // dd($ayah->id_RW);

        // dd([
        //     'kode_kelurahan' => $kodeKelurahan,
        //     'rt' => $rt,
        //     'rw' => $rw,
        // ]);

        $this->nama_anak = strip_tags($this->nama_anak);
        $this->tempat_lahir = strip_tags($this->tempat_lahir);

        SuratKelahiran::create([
            'nama_anak' => $this->nama_anak,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'hari_lahir' => $this->hari_lahir,
            'id_ibu' => $this->id_ibu,
            'id_ayah' => $this->id_ayah,
            'kode_verifikasi' => $this->generateKodeVerifikasi($code),
        ]);

        session()->flash('success', 'Surat kelahiran berhasil dibuat.');
        return redirect()->route('create.kelahiran');
    }

    private function generateKodeVerifikasi(Warga $code)
    {
        $kodeKelurahan = '10450';
        $rt = str_pad(optional($code->rt)->no_RT ?? 0, 2, '0', STR_PAD_LEFT);
        $rw = str_pad(optional($code->rw)->no_RW ?? 0, 2, '0', STR_PAD_LEFT);

        $tanggal = now();
        $dd = $tanggal->format('d');
        $mm = $tanggal->format('m');
        $yyyy = $tanggal->format('Y');

        $random = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return "{$kodeKelurahan}{$rt}{$rw}{$dd}{$mm}{$yyyy}{$random}";
    }
}
