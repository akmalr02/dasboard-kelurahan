<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Component
{
    protected string $layout = 'layouts.app';
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ];


    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
    ];

    public function mount()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
    }

    public function render()
    {
        return view('livewire.user.login', [
            'title' => 'Dashboard Kependudukan - Kelurahan Kramat'
        ]);
    }

    public function login()
    {
        // dd([
        //     'email' => $this->email,
        //     'password' => $this->password,
        // ]);

        // Rate limiting untuk mencegah brute force
        $key = 'login-attempts:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            ]);
        }

        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        // dd($credentials);

        $attempt = Auth::attempt($credentials, $this->remember);

        if ($attempt) {
            RateLimiter::clear($key);

            session()->regenerate();
            $user = Auth::user();

            logger('User login successful', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'ip' => request()->ip()
            ]);

            return $this->redirectBasedOnRole($user);
        }

        // RateLimiter::hit($key, 60);

        // logger('Failed login attempt', [
        //     'email' => $this->email,
        //     'ip' => request()->ip()
        // ]);

        // $this->addError('email', 'Email atau password salah.');

        // $this->password = '';
    }

    private function redirectBasedOnRole($user)
    {
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'warga' => redirect()->route('warga.dashboard'),
            'rt' => redirect()->route('rt.dashboard'),
            'rw' => redirect()->route('rw.dashboard'),
            default => redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali']),
        };
    }

    public function logout()
    {
        $user = Auth::user();

        // Log logout
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

    // Method untuk clear error saat user mulai mengetik
    public function updatedEmail()
    {
        $this->resetErrorBag('email');
    }

    public function updatedPassword()
    {
        $this->resetErrorBag('password');
    }
}
