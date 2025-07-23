<?php

namespace App\Livewire\User\Admin;

use App\Models\User;
use App\Models\Warga;
use App\Models\Rt;
use App\Models\Rw;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Component
{
    public $email, $password, $selectedWarga, $role;
    public bool $show = false;
    public $availableWargas = [];

    protected function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'selectedWarga' => 'required|exists:wargas,id_warga',
            'role' => 'required|in:pengelola_rt,pengelola_rw',
        ];
    }

    public function mount()
    {
        $this->loadAvailableWargas();
    }

    public function loadAvailableWargas()
    {
        $this->availableWargas = Warga::select('id_warga', 'name', 'id_RT', 'id_RW')
            ->where('role', 'warga')
            ->where('status_penduduk', 'hidup')
            ->get();
    }

    public function resetForm()
    {
        $this->reset(['email', 'password', 'selectedWarga', 'role']);
        $this->resetValidation();
    }

    public function openModal()
    {
        $this->show = true;
        $this->resetForm();
    }

    public function closeModal()
    {
        $this->show = false;
        $this->resetForm();
    }

    public function create()
    {
        $this->validate();

        $warga = Warga::find($this->selectedWarga);

        if (!$warga) {
            $this->addError('selectedWarga', 'Data warga tidak ditemukan.');
            return;
        }

        if ($this->role === 'pengelola_rt') {
            $sudahAda = Warga::where('id_RT', $warga->id_RT)
                ->where('role', 'ketua_RT')
                ->exists();

            if ($sudahAda) {
                $this->addError('role', 'RT ini sudah memiliki pengelola.');
                return;
            }
        } elseif ($this->role === 'pengelola_rw') {
            $sudahAda = Warga::where('id_RW', $warga->id_RW)
                ->where('role', 'ketua_RW')
                ->exists();

            if ($sudahAda) {
                $this->addError('role', 'RW ini sudah memiliki pengelola.');
                return;
            }
        }

        try {
            $user = User::create([
                'name' => $warga->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $this->role,
                'id_warga' => $warga->id_warga,
                'id_rt' => $warga->id_RT,
                'id_rw' => $warga->id_RW,
            ]);

            $warga->update([
                'role' => $this->role === 'pengelola_rt' ? 'ketua_RT' : 'ketua_RW',
            ]);

            if ($this->role === 'pengelola_rt') {
                Rt::where('id_RT', $warga->id_RT)->update([
                    'name_RT' => $warga->name,
                ]);
            }

            if ($this->role === 'pengelola_rw') {
                Rw::where('id_RW', $warga->id_RW)->update([
                    'name_RW' => $warga->name,
                ]);
            }

            $this->closeModal();

            $this->loadAvailableWargas();

            $this->dispatch('showSuccessMessage', 'User berhasil dibuat dan jabatan warga berhasil diperbarui!');

            $this->dispatch('$refresh');
        } catch (\Exception $e) {
            $this->addError('general', 'Terjadi kesalahan saat membuat user. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.user.admin.create-user');
    }
}
