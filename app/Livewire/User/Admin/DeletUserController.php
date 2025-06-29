<?php

namespace App\Livewire\User\Admin;

use Livewire\Component;
use App\Models\User;

class DeletUserController extends Component
{
    public bool $confirmingDelete = false;
    public $userIdToDelete;

    protected $listeners = ['confirmDeleteUser'];

    public function confirmDeleteUser($id_user)
    {
        $this->userIdToDelete = $id_user;
        $this->confirmingDelete = true;
    }

    public function deleteUser()
    {
        $user = User::find($this->userIdToDelete);

        if ($user) {
            $user->delete();
            $this->dispatch('showSuccessMessage', 'Data user berhasil dihapus!');
            $this->dispatch('$refresh');
        }

        $this->reset(['confirmingDelete', 'userIdToDelete']);
    }

    public function closeModal()
    {
        $this->reset(['confirmingDelete', 'userIdToDelete']);
    }

    public function render()
    {
        return view('livewire.user.admin.delet-user');
    }
}
