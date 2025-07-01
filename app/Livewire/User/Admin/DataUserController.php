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
    protected $listeners = ['showSuccessMessage' => 'showSuccessMessage'];
    public $successMessage = '';


    public function showSuccessMessage($message)
    {
        $this->successMessage = $message;
    }

    public function refreshUsers()
    {
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
        // dd($query->with(['rw', 'rt'])->get()->map(function ($user) {
        //     return [
        //         'id_user' => $user->id_user,
        //         'name' => $user->name,
        //         'role' => $user->role,
        //         'no_RT' => optional($user->rt)->no_RT,
        //         'no_RW' => optional($user->rw)->no_RW,
        //     ];
        // }));
        $users = $query
            ->with(['rw:id_RW,no_RW', 'rt:id_RT,no_RT']) // penting: hanya kolom yang dibutuhkan
            ->orderByRaw("FIELD(role, 'admin', 'pengelola_rw', 'pengelola_rt', 'warga')")
            ->orderBy('name')
            ->paginate(20);


        return view('livewire.user.admin.data-user', [
            'title' => 'List user',
            'user' => $users,
        ]);
    }
}
