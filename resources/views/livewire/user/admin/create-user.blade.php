@if (session()->has('success'))
    <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-2 text-sm">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-2 text-sm">
        {{ session('error') }}
    </div>
@endif

<div x-data="{ open: @entangle('show'), showPassword: false }">
    <button @click="open = true" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Tambah User
    </button>

    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
        <div @click.away="open = false" class="bg-white rounded-xl shadow-lg max-w-md w-full p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Buat akun baru</h2>

            <form wire:submit.prevent="create" class="space-y-4">
                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">E-mail</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" required autocomplete="email"
                            class="block w-full rounded-full bg-gray-100 border px-4 py-2 pr-12 text-sm text-gray-900 shadow-sm placeholder:text-gray-400
                            focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            placeholder="Masukkan Email" wire:model.defer="email">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="selectedWarga" class="block text-sm font-medium text-gray-900">Pilih Warga</label>
                    <div class="mt-2">
                        <select id="selectedWarga" wire:model.defer="selectedWarga"
                            class="block w-full rounded-full bg-gray-100 border px-4 py-2 text-sm text-gray-900 shadow-sm
            focus:border-blue-500 focus:ring-blue-500 @error('selectedWarga') border-red-500 @enderror">
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($availableWargas as $warga)
                                <option value="{{ $warga->id_warga }}">{{ $warga->name }} (NIK: {{ $warga->NKK }})
                                    (Rw:{{ $warga->id_RW }})
                                    (RT:{{ $warga->id_RT }})
                                </option>
                            @endforeach
                        </select>
                        @error('selectedWarga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Tambahkan setelah selectedWarga --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-900">Pilih Role</label>
                    <div class="mt-2">
                        <select id="role" wire:model.defer="role"
                            class="block w-full rounded-full bg-gray-100 border px-4 py-2 text-sm text-gray-900 shadow-sm
            focus:border-blue-500 focus:ring-blue-500 @error('role') border-red-500 @enderror">
                            <option value="">-- Pilih Role --</option>
                            <option value="pengelola_rt">Pengelola RT</option>
                            <option value="pengelola_rw">Pengelola RW</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <div class="relative mt-2">
                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                            autocomplete="current-password"
                            class="block w-full rounded-full bg-gray-100 border px-4 py-2 pr-12 text-sm text-gray-900 shadow-sm placeholder:text-gray-400
                            focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                            placeholder="Masukkan Password " wire:model.defer="password">

                        <!-- Tombol mata -->
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600
                            hover:text-blue-600 focus:outline-none"
                            aria-label="Toggle password visibility" tabindex="-1">
                            <!-- Mata terbuka -->
                            <span x-show="!showPassword" x-cloak>
                                <x-heroicon-o-eye class="w-5 h-5" />
                            </span>
                            <!-- Mata tertutup -->
                            <span x-show="showPassword" x-cloak>
                                <x-heroicon-o-eye-slash class="w-5 h-5" />
                            </span>
                        </button>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="w-full rounded-full bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-3 my-2 text-white text-sm font-semibold shadow hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled" wire:target="login">

                    <span>Simpan</span>

                    <span wire:loading wire:target="login" class="flex justify-center items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Memproses...
                    </span>
                </button>
                {{-- <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Simpan
                </button> --}}
            </form>
        </div>
    </div>
</div>
