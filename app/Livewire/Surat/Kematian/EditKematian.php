<?php

namespace App\Livewire\Surat\Kematian;

use Livewire\Component;
use App\Models\SuratKematian;
use Carbon\Carbon;

class EditKematian extends Component
{
    public $isOpen = false;
    public $suratId;

    public string $nama_warga = '';
    public string $tempat_lahir = '';
    public $tanggal_lahir;
    public string $jenis_kelamin = '';
    public string $agama = '';
    public string $alamat = '';
    public string $hari_meninggal = '';
    public string $tanggal_meninggal = '';
    public string $jam_meninggal = '';
    public string $penyebab = '';
    public string $tempat_pemakaman = '';

    public $isLoadingModal = false;

    protected $listeners = ['editKematian' => 'openModal'];

    protected $rules = [
        'nama_warga' => 'required|string|max:255|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
        'tempat_lahir' => 'required|string|max:100|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'agama' => 'required',
        'alamat' => 'required|string|max:255|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
        'hari_meninggal' => 'required|string|max:20',
        'tanggal_meninggal' => 'required|date',
        'jam_meninggal' => 'required|date_format:H:i',
        'penyebab' => 'nullable|string|max:255|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
        'tempat_pemakaman' => 'nullable|string|max:255|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
    ];

    protected $messages = [
        'nama_warga.required' => 'Nama warga harus diisi',
        'nama_warga.string' => 'Nama warga harus berupa text',
        'nama_warga.max' => 'Nama warga maksimal 255 karakter',
        'nama_warga.not_regex' => 'Nama warga tidak boleh mengandung script',

        'tempat_lahir.required' => 'Tempat lahir harus diisi',
        'tempat_lahir.string' => 'Tempat lahir harus berupa text',
        'tempat_lahir.max' => 'Tempat lahir maksimal 100 karakter',
        'tempat_lahir.not_regex' => 'Tempat lahir tidak boleh mengandung script',

        'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
        'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',

        'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
        'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',

        'agama.required' => 'Agama harus diisi',

        'alamat.required' => 'Alamat harus diisi',
        'alamat.string' => 'Alamat harus berupa text',
        'alamat.max' => 'Alamat maksimal 255 karakter',
        'alamat.not_regex' => 'Alamat tidak boleh mengandung script',

        'hari_meninggal.required' => 'Hari meninggal harus diisi',
        'hari_meninggal.string' => 'Hari meninggal harus berupa text',
        'hari_meninggal.max' => 'Hari meninggal maksimal 20 karakter',

        'tanggal_meninggal.required' => 'Tanggal meninggal harus diisi',
        'tanggal_meninggal.date' => 'Tanggal meninggal harus berupa tanggal yang valid',

        'jam_meninggal.required' => 'Jam meninggal harus diisi',
        'jam_meninggal.date_format' => 'Jam meninggal harus dalam format HH:MM (contoh: 14:30)',

        'penyebab.string' => 'Penyebab harus berupa text',
        'penyebab.max' => 'Penyebab maksimal 255 karakter',
        'penyebab.not_regex' => 'Penyebab tidak boleh mengandung script',

        'tempat_pemakaman.string' => 'Tempat pemakaman harus berupa text',
        'tempat_pemakaman.max' => 'Tempat pemakaman maksimal 255 karakter',
        'tempat_pemakaman.not_regex' => 'Tempat pemakaman tidak boleh mengandung script',
    ];

    public function openModal($data)
    {
        $this->suratId = $data['id_kematian'];

        $surat = SuratKematian::find($this->suratId);

        if (!$surat) {
            session()->flash('error', "Surat dengan ID {$this->suratId} tidak ditemukan.");
            return;
        }

        $this->fill([
            'nama_warga' => $surat->nama_warga ?? '',
            'tempat_lahir' => $surat->tempat_lahir ?? '',
            'tanggal_lahir' => $surat->tanggal_lahir ?? '',
            'jenis_kelamin' => $surat->jenis_kelamin ?? '',
            'agama' => $surat->agama ?? '',
            'alamat' => $surat->alamat ?? '',
            'hari_meninggal' => $surat->hari_meninggal ?? '',
            'tanggal_meninggal' => $surat->tanggal_meninggal ?? '',
            'jam_meninggal' => $surat->jam_meninggal ? Carbon::parse($surat->jam_meninggal)->format('H:i') : '',
            'penyebab' => $surat->penyebab ?? '',
            'tempat_pemakaman' => $surat->tempat_pemakaman ?? '',
        ]);

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset([
            'nama_warga',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'alamat',
            'hari_meninggal',
            'tanggal_meninggal',
            'jam_meninggal',
            'penyebab',
            'tempat_pemakaman',
        ]);
    }

    public function update()
    {
        if (str_contains($this->jam_meninggal, '.')) {
            $this->jam_meninggal = str_replace('.', ':', $this->jam_meninggal);
        }

        $this->validate();

        $surat = SuratKematian::findOrFail($this->suratId);

        $surat->update([
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
        ]);

        $this->closeModal();
        $this->dispatch('kematianUpdated');
        $this->dispatch('showSuccessMessage', 'Data berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.surat.kematian.edit-kematian');
    }
}
