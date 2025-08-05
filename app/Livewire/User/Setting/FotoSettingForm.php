<?php

namespace App\Livewire\User\Setting;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoSettingForm extends Component
{
    use WithFileUploads;

    public User $user;
    public $foto_profil;
    public $showFotoModal = false;

    protected $rules = [
        'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];

    protected $messages = [
        'foto_profil.required' => 'Silakan pilih foto profil.',
        'foto_profil.image' => 'File harus berupa gambar.',
        'foto_profil.mimes' => 'Format foto harus JPEG, PNG, JPG, atau GIF.',
        'foto_profil.max' => 'Ukuran file maksimal 2MB.',
        'foto_profil.uploaded' => 'Gagal mengupload file. Periksa ukuran file.'
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updatedFotoProfil()
    {
        $this->resetErrorBag('foto_profil');

        if ($this->foto_profil) {
            if (!$this->foto_profil->isValid()) {
                $this->addError('foto_profil', 'File tidak valid atau rusak.');
                $this->foto_profil = null;
                return;
            }

            $fileSizeInMB = $this->foto_profil->getSize() / 1048576;
            if ($fileSizeInMB > 2) {
                $this->addError('foto_profil', 'Ukuran file maksimal 2MB.');
                $this->foto_profil = null;
                return;
            }

            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!in_array($this->foto_profil->getMimeType(), $allowedMimes)) {
                $this->addError('foto_profil', 'Format file harus JPEG, PNG, JPG, atau GIF.');
                $this->foto_profil = null;
                return;
            }

            $this->validateOnly('foto_profil');
        }
    }

    public function uploadFotoProfil()
    {
        if (!$this->foto_profil) {
            $this->addError('foto_profil', 'Silakan pilih foto profil terlebih dahulu.');
            return;
        }

        if (!$this->foto_profil->isValid()) {
            $this->addError('foto_profil', 'File tidak valid atau gagal diupload.');
            return;
        }

        $fileSizeInBytes = $this->foto_profil->getSize();
        $maxSizeInBytes = 2 * 1024 * 1024;

        if ($fileSizeInBytes > $maxSizeInBytes) {
            $this->addError('foto_profil', 'Ukuran file maksimal 2MB.');
            return;
        }

        $this->validate();

        if ($this->user->foto_profil && Storage::disk('public')->exists($this->user->foto_profil)) {
            Storage::disk('public')->delete($this->user->foto_profil);
        }

        $filename = time() . '_' . $this->user->id . '.' . $this->foto_profil->getClientOriginalExtension();
        $path = $this->foto_profil->storeAs('foto_profil', $filename, 'public');

        $this->user->update(['foto_profil' => $path]);

        $this->reset(['foto_profil', 'showFotoModal']);
        $this->resetErrorBag();

        session()->flash('success', 'Foto profil berhasil diperbarui.');
        $this->dispatch('foto-uploaded');
    }

    public function deleteFotoProfil()
    {
        if ($this->user->foto_profil && Storage::disk('public')->exists($this->user->foto_profil)) {
            Storage::disk('public')->delete($this->user->foto_profil);
        }

        $this->user->update(['foto_profil' => null]);

        session()->flash('success', 'Foto profil berhasil dihapus.');
        $this->dispatch('foto-deleted');
    }

    public function closeModal()
    {
        $this->reset(['foto_profil', 'showFotoModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user.setting.foto-setting-form');
    }
}
