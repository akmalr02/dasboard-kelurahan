<?php

namespace App\Livewire\User\Setting;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class PasswordSettingForm extends Component
{
    use WithFileUploads;

    public User $user;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $showPasswordModal = false;
    public $isUpdating = false;

    protected function rules()
    {
        return [
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ];
    }

    protected $messages = [
        'current_password.required' => 'Password saat ini wajib diisi.',
        'new_password.required' => 'Password baru wajib diisi.',
        'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        'new_password.min' => 'Password minimal 8 karakter.',
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function gantiPassword()
    {
        $this->isUpdating = true;
        $this->validate();

        // Cek password saat ini
        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Password saat ini tidak benar.');
            $this->isUpdating = false;
            return;
        }

        // Cek apakah password baru sama dengan password lama
        if (Hash::check($this->new_password, $this->user->password)) {
            $this->addError('new_password', 'Password baru tidak boleh sama dengan password lama.');
            $this->isUpdating = false;
            return;
        }

        $this->user->update(['password' => Hash::make($this->new_password)]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation', 'showPasswordModal']);
        $this->isUpdating = false;

        session()->flash('success', 'Password berhasil diperbarui.');
        $this->dispatch('password-updated');
    }

    public function closeModal()
    {
        $this->reset(['current_password', 'new_password', 'new_password_confirmation', 'showPasswordModal']);
    }

    public function render()
    {
        return view('livewire.user.setting.password-setting-form');
    }
}
