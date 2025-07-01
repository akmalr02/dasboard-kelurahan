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
        // Optimasi: Set userId dulu, baru load data ketika modal sudah terbuka
        $this->userId = $id_user;
        $this->show = true;

        // Defer data loading menggunakan dispatch
        $this->dispatch('loadUserData');
    }

    public function loadUserData()
    {
        if ($this->userId) {
            // Optimasi: Gunakan select untuk ambil kolom yang diperlukan saja
            $this->user = User::select('id_user', 'name', 'email', 'role')
                ->find($this->userId);

            if ($this->user) {
                $this->name = $this->user->name;
                $this->email = $this->user->email;
                $this->role = $this->user->role;
            }
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

        // Optimasi: Langsung update tanpa find lagi
        User::where('id_user', $this->userId)->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        $this->dispatch('showSuccessMessage', 'Data user berhasil diperbarui!');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.user.admin.edit-user');
    }
}
