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
    // public $isUploading = false;

    protected $rules = [
        'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];

    protected $messages = [
        'foto_profil.required' => 'Silakan pilih foto profil.',
        'foto_profil.image' => 'File harus berupa gambar.',
        'foto_profil.mimes' => 'Format foto harus JPEG, PNG, JPG, atau GIF.',
        'foto_profil.max' => 'Ukuran foto maksimal 2MB.'
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function uploadFotoProfil()
    {
        $this->validate();

        // dd($this->validate());
        // Hapus foto lama jika ada
        if ($this->user->foto_profil && Storage::disk('public')->exists($this->user->foto_profil)) {
            Storage::disk('public')->delete($this->user->foto_profil);
        }

        // Upload foto baru
        $path = $this->foto_profil->store('foto_profil', 'public');

        $this->user->update(['foto_profil' => $path]);

        $this->reset(['foto_profil', 'showFotoModal']);
        // $this->isUploading = false;

        session()->flash('success', 'Foto profil berhasil diunggah.');
        $this->dispatch('foto-uploaded');
    }

    public function hapusFotoProfil()
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
    }

    public function render()
    {
        return view('livewire.user.setting.foto-setting-form');
    }
}
