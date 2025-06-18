<?php

namespace App\Livewire\User\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class DataUserController extends Component
{
    use WithPagination;

    protected string $layout = 'layouts.app';
    protected $paginationTheme = 'tailwind';

    public $search = '';
    protected $listeners = ['user-created' => 'refreshUsers'];

    public function refreshUsers()
    {
        // Bisa langsung reset halaman agar data baru muncul
        $this->resetPage();
        $this->dispatch('$refresh');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }
    public function render()
    {
        $query = User::query();

        if (!empty(trim($this->search))) {
            $searchTerm = trim($this->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('role', 'like', $searchTerm);
            });
        }
        // $user = $query->orderBy('role')->orderBy('name')->get();
        // dd($user->pluck('role')->unique());

        return view('livewire.user.admin.data-user', [
            'title' => 'List user',
            'user' => $query->orderByRaw("FIELD(role, 'admin', 'pengelola_rw', 'pengelola_rt', 'warga')")
                ->orderBy('name')
                ->paginate(20),
        ]);
    }
}
