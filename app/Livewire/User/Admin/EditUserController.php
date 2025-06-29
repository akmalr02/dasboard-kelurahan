<?php

namespace App\Livewire\User\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class EditUserController extends Component
{
    public bool $show = false;
    public $user;
    public $userId;
    public $name, $email, $role;
    public string $successMessage = '';

    protected $listeners = ['editUser'];

    public function editUser($id_user)
    {
        $this->user = User::find($id_user);

        if ($this->user) {
            $this->userId = $this->user->id_user;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role = $this->user->role;
            $this->show = true;
        }
    }

    public function closeModal()
    {
        $this->reset(['show', 'userId', 'name', 'email', 'role', 'user']);
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId . ',id_user',
            'role' => 'required|in:admin,pengelola_rw,pengelola_rt,warga',
        ]);

        $user = User::find($this->userId);

        if ($user) {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);
        }
        $this->dispatch('showSuccessMessage', 'Data user berhasil diperbarui!');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.user.admin.edit-user');
    }
}
