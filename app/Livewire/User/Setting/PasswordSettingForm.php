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

    protected function rules()
    {
        return [
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed'],
            'new_password_confirmation' => 'required',
        ];
    }

    protected $messages = [
        'current_password.required' => 'Password saat ini wajib diisi.',
        'new_password.required' => 'Password baru wajib diisi.',
        'new_password.confirmed' => 'Konfirmasi password tidak cocok dengan password baru.',
        'new_password_confirmation.required' => 'Konfirmasi password baru wajib diisi.',
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function gantiPassword()
    {
        $this->resetErrorBag();

        $this->validate();

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Password lama tidak cocok.');
            return;
        }

        if (Hash::check($this->new_password, $this->user->password)) {
            $this->addError('new_password', 'Password baru harus berbeda dengan password saat ini.');
            return;
        }

        if (!$this->validatePasswordRequirements($this->new_password)) {
            return;
        }

        try {
            $this->user->update(['password' => Hash::make($this->new_password)]);

            $this->reset(['current_password', 'new_password', 'new_password_confirmation', 'showPasswordModal']);
            $this->resetErrorBag();

            session()->flash('success', 'Password berhasil diperbarui.');
            $this->dispatch('password-updated');
        } catch (\Exception $e) {
            $this->addError('general', 'Terjadi kesalahan saat memperbarui password. Silakan coba lagi.');
        }
    }

    private function validatePasswordRequirements($password)
    {
        $errors = [];
        $isValid = true;

        foreach ($errors as $error) {
            $this->addError('new_password', $error);
        }

        return $isValid;
    }

    public function closeModal()
    {
        $this->reset(['current_password', 'new_password', 'new_password_confirmation', 'showPasswordModal']);
        $this->resetErrorBag();
    }

    public function updatedCurrentPassword()
    {
        if (!empty($this->current_password)) {
            $this->resetErrorBag('current_password');

            if (!Hash::check($this->current_password, $this->user->password)) {
                $this->addError('current_password', 'Password lama tidak cocok');
            }
        }
    }

    public function updatedNewPassword()
    {
        if (!empty($this->new_password)) {
            $this->resetErrorBag('new_password');

            if (Hash::check($this->new_password, $this->user->password)) {
                $this->addError('new_password', '❌ Password baru harus berbeda dengan password saat ini.');
                return;
            }

            $this->validatePasswordRequirements($this->new_password);
        }
    }

    public function updatedNewPasswordConfirmation()
    {
        if (!empty($this->new_password_confirmation) && !empty($this->new_password)) {
            $this->resetErrorBag('new_password_confirmation');

            if ($this->new_password !== $this->new_password_confirmation) {
                $this->addError('new_password_confirmation', 'Konfirmasi password tidak cocok dengan password baru.');
            }
        }
    }

    public function render()
    {
        return view('livewire.user.setting.password-setting-form');
    }
}
