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
        'ttd_digital.max' => 'Ukuran file maksimal 1MB.',
        'ttd_digital.uploaded' => 'Gagal mengupload file. Periksa ukuran file.'
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updatedTtdDigital()
    {
        $this->resetErrorBag('ttd_digital');

        if ($this->ttd_digital) {
            if (!$this->ttd_digital->isValid()) {
                $this->addError('ttd_digital', 'File tidak valid atau rusak.');
                $this->ttd_digital = null;
                return;
            }

            $fileSizeInMB = $this->ttd_digital->getSize() / 1048576;
            if ($fileSizeInMB > 1) {
                $this->addError('ttd_digital', 'Ukuran file maksimal 1MB.');
                $this->ttd_digital = null;
                return;
            }

            $allowedMimes = ['image/png', 'image/jpg', 'image/jpeg'];
            if (!in_array($this->ttd_digital->getMimeType(), $allowedMimes)) {
                $this->addError('ttd_digital', 'Format file harus PNG, JPG, atau JPEG.');
                $this->ttd_digital = null;
                return;
            }

            $this->validateOnly('ttd_digital');
        }
    }

    public function uploadTandaTangan()
    {
        if (!$this->ttd_digital) {
            $this->addError('ttd_digital', 'Silakan pilih file tanda tangan terlebih dahulu.');
            return;
        }

        if (!$this->ttd_digital->isValid()) {
            $this->addError('ttd_digital', 'File tidak valid atau gagal diupload.');
            return;
        }

        $fileSizeInBytes = $this->ttd_digital->getSize();
        $maxSizeInBytes = 1 * 1024 * 1024;

        if ($fileSizeInBytes > $maxSizeInBytes) {
            $this->addError('ttd_digital', 'Ukuran file maksimal 1MB.');
            return;
        }

        $this->validate();

        if ($this->user->ttd_digital && Storage::disk('public')->exists($this->user->ttd_digital)) {
            Storage::disk('public')->delete($this->user->ttd_digital);
        }

        $filename = 'ttd_' . time() . '_' . $this->user->id . '.' . $this->ttd_digital->getClientOriginalExtension();
        $path = $this->ttd_digital->storeAs('ttd_digital', $filename, 'public');

        $this->user->update(['ttd_digital' => $path]);

        $this->reset(['ttd_digital', 'showTtdModal']);
        $this->resetErrorBag();

        session()->flash('success', 'Tanda tangan digital berhasil disimpan.');
        $this->dispatch('ttd-uploaded');
    }

    public function deleteTtdDigital()
    {
        if ($this->user->ttd_digital && Storage::disk('public')->exists($this->user->ttd_digital)) {
            Storage::disk('public')->delete($this->user->ttd_digital);
        }

        $this->user->update(['ttd_digital' => null]);

        session()->flash('success', 'Tanda tangan digital berhasil dihapus.');
        $this->dispatch('ttd-deleted');
    }

    public function closeModal()
    {
        $this->reset(['ttd_digital', 'showTtdModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user.setting.ttd-setting-form');
    }
}
