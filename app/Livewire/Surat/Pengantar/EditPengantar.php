<?php

namespace App\Livewire\Surat\Pengantar;

use Livewire\Component;
use App\Models\SuratPengantar;

class EditPengantar extends Component
{
    public $isOpen = false;
    public $suratId;

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
    public $isLoadingModal = false;

    protected $listeners = ['editPengantar' => 'openModal'];

    public function openModal($data)
    {
        $this->suratId = $data['id_pengajuan'];

        $surat = SuratPengantar::find($this->suratId);

        if (!$surat) {
            session()->flash('error', "Surat dengan ID {$this->suratId} tidak ditemukan.");
            return;
        }

        $this->fill([
            'nama' => $surat->nama ?? '',
            'NIK' => $surat->NIK ?? '',
            'NKK' => $surat->NKK ?? '',
            'jenis_kelamin' => $surat->jenis_kelamin ?? '',
            'tempat_lahir' => $surat->tempat_lahir ?? '',
            'tanggal_lahir' => $surat->tanggal_lahir,
            'status_perkawinan' => $surat->status_perkawinan ?? '',
            'kewarganegaraan' => $surat->kewarganegaraan ?? '',
            'agama' => $surat->agama ?? '',
            'pekerjaan' => $surat->pekerjaan ?? '',
            'alamat' => $surat->alamat ?? '',
            'keperluan' => $surat->keperluan ?? '',
            'email' => $surat->email ?? '',
        ]);

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset([
            'nama',
            'NIK',
            'NKK',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'status_perkawinan',
            'kewarganegaraan',
            'agama',
            'pekerjaan',
            'alamat',
            'keperluan',
            'email',
            'suratId'
        ]);
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:225|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
            'NIK' => 'required|numeric|digits_between:8,20',
            'NKK' => 'required|numeric|digits_between:8,20',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'pekerjaan' => 'nullable|string|max:100|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
            'alamat' => 'nullable|string|max:225|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
            'keperluan' => 'required|string|not_regex:/<script\\b[^>]*>(.*?)<\\/script>/i',
            'email' => 'required|email|max:225',
        ]);

        $surat = SuratPengantar::findOrFail($this->suratId);

        $surat->update([
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
            'keperluan' => strip_tags($this->keperluan),
            'email' => $this->email,
        ]);

        $this->closeModal();
        $this->dispatch('pengantarUpdated');
        $this->dispatch('showSuccessMessage', 'Data berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.surat.pengantar.edit-pengantar');
    }
}
