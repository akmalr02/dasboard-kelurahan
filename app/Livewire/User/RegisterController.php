<?php

namespace App\Livewire\User;

use App\Models\Warga;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Component
{
    protected string $layout = 'layouts.app';

    public $email, $password, $NKK;

    public function rules()
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:6'],
            'NKK' => ['required'],
        ];
    }

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
        'NKK.required' => 'NKK wajib diisi.',
        'email.not_regex' => 'Input email mengandung tag yang tidak diizinkan.',
        'password.not_regex' => 'Input password mengandung tag yang tidak diizinkan.',
        'NKK.not_regex' => 'Input NKK mengandung tag yang tidak diizinkan.',

    ];

    public function render()
    {
        // dd('berhasil');
        return view('livewire.user.register');
    }

    public function register()
    {
        $this->validate();

        $this->email = strip_tags($this->email);
        $this->password = strip_tags($this->password);
        $this->NKK = strip_tags($this->NKK);

        $warga = Warga::where('NKK', $this->NKK)->where('status_penduduk', 'hidup')
            ->first();

        if (!$warga) {
            $this->addError('NKK', 'NKK tidak ditemukan dalam data warga.');
            $this->addError('status_penduduk', 'Penduduk sudah Pindah atau Meninggal');
            return;
        }

        $cek = User::where('id_warga', $warga->id_warga)->first();

        if ($cek) {
            $this->addError('NKK', 'NKK Sudah mempunyai akun');
            return;
        };

        $user = [
            'name' => $warga->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'warga',
            'id_warga' => $warga->id_warga,
            'id_rt' => $warga->rt->no_RT,
            'id_rw' => $warga->rw->no_RW,
        ];

        User::create($user);

        session()->flash('message', 'Registrasi berhasil! Silakan login.');
        return redirect()->route('login');

        // dd($user);
    }
}
