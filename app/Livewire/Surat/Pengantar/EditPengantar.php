<?php

namespace App\Livewire\Surat\Pengantar;

use Livewire\Component;
use App\Models\SuratPengantar;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditPengantar extends Component
{
    use WithFileUploads;
    public $isOpen = false;
    public $suratId;
    public $surat;

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
    public $foto_ktp_lama;
    public $file_pdf_lama;
    public $foto_ktp;
    public $file_pdf;

    protected $listeners = ['editPengantar' => 'openModal'];

    protected array $rules = [
        'nama' => 'required|string|max:225',
        'NIK' => 'required|numeric|digits_between:8,20',
        'NKK' => 'required|numeric|digits_between:8,20',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'required|string|max:100',
        'tanggal_lahir' => 'required|date',
        'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
        'kewarganegaraan' => 'required|in:WNI,WNA',
        'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu,Lainnya',
        'pekerjaan' => 'required|string|max:100',
        'alamat' => 'required|string|max:225',
        'keperluan' => 'required|string|min:10|max:500|not_regex:/<script\b[^>]*>(.*?)<\/script>/i',
        'email' => 'required|email|max:225',
        'foto_ktp' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'file_pdf' => 'nullable|file|mimes:pdf|max:5120',
    ];

    public function openModal($data)
    {
        $this->suratId = $data['id_pengajuan'];

        $surat = SuratPengantar::find($this->suratId);

        if (!$surat) {
            session()->flash('error', "Surat dengan ID {$this->suratId} tidak ditemukan.");
            return;
        }

        $this->surat = $surat;

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
            'foto_ktp_lama' => $surat->foto_ktp,
            'file_pdf_lama' => $surat->file_pdf,
        ]);

        $this->foto_ktp = null;
        $this->file_pdf = null;

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
            'foto_ktp',
            'file_pdf',
            'foto_ktp_lama',
            'file_pdf_lama',
            'suratId',
            'surat'
        ]);
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->validate();

        try {
            $surat = SuratPengantar::findOrFail($this->suratId);

            $fotoKtpPath = $surat->foto_ktp;
            $filePdfPath = $surat->file_pdf;

            if ($this->foto_ktp) {
                if ($this->foto_ktp_lama && Storage::disk('public')->exists($this->foto_ktp_lama)) {
                    Storage::disk('public')->delete($this->foto_ktp_lama);
                }
                $fotoKtpPath = $this->foto_ktp->store('surat-pengantar/foto-ktp', 'public');
            }

            if ($this->file_pdf) {
                if ($this->file_pdf_lama && Storage::disk('public')->exists($this->file_pdf_lama)) {
                    Storage::disk('public')->delete($this->file_pdf_lama);
                }
                $filePdfPath = $this->file_pdf->store('surat-pengantar/file-pdf', 'public');
            }

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
                'foto_ktp' => $fotoKtpPath,
                'file_pdf' => $filePdfPath,
            ]);

            $this->closeModal();
            $this->dispatch('pengantarUpdated');
            $this->dispatch('showSuccessMessage', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.surat.pengantar.edit-pengantar', [
            'surat' => $this->surat,
        ]);
    }
}
