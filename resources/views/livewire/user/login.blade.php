<div class="p-4 md:p-6 flex items-center justify-center min-h-screen bg-white">
    <div class="flex flex-col md:flex-row bg-gray-100 rounded-2xl shadow-2xl overflow-hidden w-full max-w-6xl">

        <!-- Kiri: Form Login -->
        <div class="w-full md:w-1/2 p-8 sm:p-10" x-data="{ showPassword: false, loading: false }" x-cloak>
            <!-- Logo dan Judul -->
            <div class="flex items-center space-x-4 mb-10">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Selamat Datang!</h1>
                    <h1 class="py-3 text-gray-900">Silahkan Login Terlebih Dahulu</h1>
                </div>
            </div>

            <form class="space-y-6" wire:submit.prevent="login" method="POST" @submit="loading = true">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email Anda</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" required autocomplete="email"
                            class="block w-full rounded-full bg-gray-100 border border-gray-300 
                                px-4 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 
                                focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Masukkan Email Anda..." required value="{{ old('email') }}"
                            wire:model.defer="email">
                    </div>
                </div>

                <!-- Password -->
                <div x-data="{ showPassword: false }" class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-900">Password
                    </label>

                    <div class="relative mt-2">
                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                            autocomplete="current-password"
                            class="block w-full rounded-full bg-gray-100 border border-gray-300
                                    px-4 py-2 pr-12 text-sm text-gray-900 shadow-sm placeholder:text-gray-400
                                    focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan Password Anda..." required value="{{ old('password') }}"
                            wire:model.defer="password">

                        <!-- Tombol mata -->
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600
                                    hover:text-blue-600 focus:outline-none"
                            aria-label="Toggle password visibility" tabindex="-1">
                            <!-- mata (lihat) -->
                            <span x-show="!showPassword" x-cloak>
                                <x-heroicon-o-eye class="w-5 h-5" />
                            </span>

                            <!-- mata coret (sembunyikan) -->
                            <span x-show="showPassword" x-cloak>
                                <x-heroicon-o-eye-slash class="w-5 h-5" />
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Tombol Login -->
                <div>
                    <button type="submit"
                        class="w-full rounded-full bg-gradient-to-r from-blue-500 to-blue-500 px-4 py-3 my-2 text-white text-sm font-semibold shadow hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
                        :disabled="loading">
                        <span x-show="!loading">Masuk</span>
                        <span x-show="loading" class="flex justify-center items-center gap-1">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z"></path>
                            </svg>
                            Loading...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Kanan: Ilustrasi -->
        <div class="hidden md:flex items-center justify-center w-1/2 bg-white-100 p-8">
            <img src="{{ asset('img/kelurahan.jpg') }}" alt="Login Illustration" class="w-full max-w-md">
        </div>
    </div>
</div>
