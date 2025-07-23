<?php

namespace App\Livewire\Surat\Kelahiran;

use Livewire\Component;
use App\Models\SuratKelahiran;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;

class EditKelahiran extends Component
{
    public $isOpen = false;
    public $suratId;

    public $nama_anak, $anak_ke, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $hari_lahir;
    public $id_ibu, $id_ayah;

    public $isLoadingModal = false;

    protected $listeners = ['editKelahiran' => 'openModal'];
    public $anggotaKeluarga = [];

    public function rules()
    {
        return [
            'nama_anak' => 'required|string|max:225',
            'anak_ke' => 'required|string|max:225',
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
        'anak_ke.required' => 'Nama anak wajib diisi.',
        'anak_ke.max' => 'Nama anak maksimal 225 karakter.',
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

    public function openModal($data)
    {
        $this->suratId = $data['id_kelahiran'];
        $surat = SuratKelahiran::with(['ibu', 'ayah'])->find($this->suratId);

        if (!$surat) {
            session()->flash('error', "Data surat tidak ditemukan.");
            return;
        }

        $user = Auth::user();
        if ($user->warga && $user->warga->NKK) {
            $this->anggotaKeluarga = Warga::where('NKK', $user->warga->NKK)
                ->where('status_penduduk', 'hidup')
                ->get();
        }

        $this->fill([
            'nama_anak' => $surat->nama_anak,
            'anak_ke' => $surat->anak_ke,
            'jenis_kelamin' => $surat->jenis_kelamin,
            'tempat_lahir' => $surat->tempat_lahir,
            'tanggal_lahir' => $surat->tanggal_lahir,
            'hari_lahir' => $surat->hari_lahir,
            'id_ibu' => $surat->id_ibu,
            'id_ayah' => $surat->id_ayah,
        ]);

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset([
            'suratId',
            'nama_anak',
            'anak_ke',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'hari_lahir',
            'id_ibu',
            'id_ayah',
        ]);
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate();

        $surat = SuratKelahiran::findOrFail($this->suratId);

        $surat->update([
            'nama_anak' => $this->nama_anak,
            'anak_ke' => $this->anak_ke,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'hari_lahir' => $this->hari_lahir,
            'id_ibu' => $this->id_ibu,
            'id_ayah' => $this->id_ayah,
        ]);

        $this->closeModal();
        $this->dispatch('kelahiranUpdated');
        $this->dispatch('showSuccessMessage', 'Data berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.surat.kelahiran.edit-kelahiran', [
            'anggotaKeluarga' => $this->anggotaKeluarga,
        ]);
    }
}
