<?php

namespace App\Livewire\User\Setting;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
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
        'foto_profil.max' => 'Ukuran file terlalu besar.',
        'foto_profil.uploaded' => 'Ukuran file terlalu besar.'
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updatedFotoProfil()
    {
        $this->resetErrorBag('foto_profil');

        if ($this->foto_profil) {
            $fileSizeInMB = $this->foto_profil->getSize() / 1048576;

            if ($fileSizeInMB > 2) {
                $this->addError('foto_profil', 'Ukuran file terlalu besar.');
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

        $fileSizeInBytes = $this->foto_profil->getSize();
        $maxSizeInBytes = 2 * 1024 * 1024;

        if ($fileSizeInBytes > $maxSizeInBytes) {
            $this->addError('foto_profil', 'Ukuran file terlalu besar.');
            return;
        }

        $this->validate();

        if ($this->user->foto_profil && Storage::disk('public')->exists($this->user->foto_profil)) {
            Storage::disk('public')->delete($this->user->foto_profil);
        }

        $path = $this->foto_profil->store('foto_profil', 'public');

        $this->user->update(['foto_profil' => $path]);

        $this->reset(['foto_profil', 'showFotoModal']);

        session()->flash('success', 'Foto berhasil diperbarui.');
        $this->dispatch('foto-uploaded');
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
