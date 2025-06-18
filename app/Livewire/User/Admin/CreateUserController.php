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
        // Ambil hanya warga yang belum punya user dan jabatannya masih warga
        $this->availableWargas = Warga::where('role', 'warga')
            ->whereNull('id_user')
            ->where('status_penduduk', 'hidup')
            ->get();
    }

    public function resetForm()
    {
        $this->email = '';
        $this->password = '';
        $this->selectedWarga = '';
        $this->role = '';
        $this->resetValidation();
    }

    public function create()
    {

        $this->validate();

        // dd([
        //     'email' => $this->email,
        //     'password' => $this->password,
        //     'selectedWarga' => $this->selectedWarga,
        //     'role' => $this->role,
        // ]);

        $warga = Warga::find($this->selectedWarga);

        if (!$warga) {
            $this->addError('selectedWarga', 'Data warga tidak ditemukan.');
            return;
        }

        if ($warga->id_user !== null || User::where('id_user', $warga->id_warga)->exists()) {
            $this->addError('selectedWarga', 'Warga ini sudah memiliki akun user.');
            return;
        }

        if ($this->role === 'pengelola_rt') {
            $sudahAda = Warga::where('id_RT', $warga->id_RT)
                ->where('role', 'ketua_RT')
                ->exists();

            if ($sudahAda) {
                session()->flash('error', 'RT ini sudah memiliki pengelola.');
                return;
            }
        } elseif ($this->role === 'pengelola_rw') {
            $sudahAda = Warga::where('id_RW', $warga->id_RW)
                ->where('role', 'ketua_RW')
                ->exists();

            if ($sudahAda) {
                session()->flash('error', 'RW ini sudah memiliki pengelola.');
                return;
            }
        }

        // Buat user
        $user = User::create([
            'name' => $warga->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        // Update jabatan warga dan hubungkan ke user
        $warga->update([
            'role' => $this->role === 'pengelola_rt' ? 'ketua_RT' : 'ketua_RW',
            'id_user' => $user->id,
        ]);

        // Jika pengelola RT, update tabel rts agar name_RT = nama user
        if ($this->role === 'pengelola_rt') {
            Rt::where('id_RT', $warga->id_RT)->update([
                'name_RT' => $warga->name,
                'id_user' => $user->id,
            ]);
        }

        // Jika pengelola RW, update tabel rws agar name_RW = nama user
        if ($this->role === 'pengelola_rw') {
            Rw::where('id_RW', $warga->id_RW)->update([
                'name_RW' => $warga->name,
                'id_user' => $user->id,
            ]);
        }


        // Reset form
        $this->resetForm();
        $this->show = false;

        // Refresh available wargas
        $this->mount();

        // Dispatch event untuk refresh halaman utama
        $this->dispatch('user-created');

        // Set flash message
        session()->flash('success', 'User berhasil dibuat dan jabatan warga diubah.');

        // Optional: Refresh component ini juga
        $this->dispatch('$refresh');
    }

    public function render()
    {
        // $this->availableWargas = Warga::where('jabatan', 'warga')->get();
        // dd($warga);
        $this->availableWargas = Warga::where('role', 'warga')
            ->whereNull('id_user')
            ->where('status_penduduk', 'hidup')
            ->get();

        return view('livewire.user.admin.create-user');
    }
}
