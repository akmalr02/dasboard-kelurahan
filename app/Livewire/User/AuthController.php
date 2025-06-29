<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AuthController extends Component
{
    protected string $layout = 'layouts.app';

    public $email, $password;
    public bool $remember = false;

    public function rules()
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ];
    }

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
        'email.not_regex' => 'Input email mengandung tag yang tidak diizinkan.',
        'password.not_regex' => 'Input password mengandung tag yang tidak diizinkan.',

    ];

    public function render()
    {
        return view('livewire.user.login', [
            'title' => 'Dashboard Kependudukan - Kelurahan Kramat'
        ]);
    }

    public function login()
    {
        // logger('Form login dipanggil');

        // dd($this->email, $this->password, $this->remember);

        $this->validate();

        $this->email = strip_tags($this->email);
        $this->password = strip_tags($this->password);


        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (!Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', 'Email atau password salah.');
            return null;
        }

        $user = Auth::user();

        // logger('Login berhasil sebagai ' . $user->name);

        session()->flash('message', 'Login berhasil sebagai: ' . $user->name . ' (' . $user->role . ')');
        // dd('Login berhasil sebagai', Auth::user());

        $redirectUrl = match ($user->role) {
            'admin'         => route('admin.dashboard'),
            'warga'         => route('warga.dashboard'),
            'pengelola_rt'  => route('rt.dashboard'),
            'pengelola_rw'  => route('rw.dashboard'),
            default => route('login'),
        };

        // dd($redirectUrl);
        return redirect()->to($redirectUrl);
    }

    public function logout()
    {
        // dd('berhasil');
        $user = Auth::user();

        if ($user) {
            logger('User logout', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
        }

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Anda telah logout.');
    }
}
