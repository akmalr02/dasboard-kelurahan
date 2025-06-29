<?php

namespace App\Livewire\User\Admin;

use Livewire\Component;
use App\Models\User;

class DetailUserController extends Component
{
    public bool $show = false;
    public $user;

    protected $listeners = ['showUserDetail'];

    public function showUserDetail($id_user)
    {
        $this->user = User::findOrFail($id_user);
        $this->show = true;

        // dd($this->user);
    }

    public function closeModal()
    {
        $this->show = false;
        $this->user = null;
    }

    public function render()
    {
        return view('livewire.user.admin.detail-user');
    }
}
