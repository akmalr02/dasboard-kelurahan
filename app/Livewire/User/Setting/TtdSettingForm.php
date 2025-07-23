<?php

namespace App\Livewire\User\Setting;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TtdSettingForm extends Component
{
    use WithFileUploads;

    public User $user;
    public $ttd_digital;
    public $showTtdModal = false;

    protected $rules = [
        'ttd_digital' => 'required|image|mimes:png,jpg,jpeg|max:1024'
    ];

    protected $messages = [
        'ttd_digital.required' => 'Silakan pilih file tanda tangan.',
        'ttd_digital.image' => 'File harus berupa gambar.',
        'ttd_digital.mimes' => 'Format tanda tangan harus PNG, JPG, atau JPEG.',
        'ttd_digital.max' => 'Ukuran file maksimal 1MB.'
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function uploadTandaTangan()
    {
        $this->validate();

        if ($this->user->ttd_digital && Storage::disk('public')->exists($this->user->ttd_digital)) {
            Storage::disk('public')->delete($this->user->ttd_digital);
        }

        $path = $this->ttd_digital->store('ttd_digital', 'public');

        $this->user->update(['ttd_digital' => $path]);

        $this->reset(['ttd_digital', 'showTtdModal']);

        session()->flash('success', 'Gambar tanda tangan tersimpan.');
        $this->dispatch('ttd-uploaded');
    }

    public function closeModal()
    {
        $this->reset(['ttd_digital', 'showTtdModal']);
    }

    public function render()
    {
        return view('livewire.user.setting.ttd-setting-form');
    }
}
