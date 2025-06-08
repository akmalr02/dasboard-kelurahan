<div class="p-4 md:p-6 flex items-center justify-center min-h-screen bg-white">
    <div class="flex flex-col md:flex-row bg-gray-100 rounded-2xl shadow-2xl overflow-hidden w-full max-w-6xl">

        <!-- Kiri: Form Login -->
        <div class="w-full md:w-1/2 p-8 sm:p-10" x-data="{ showPassword: false }" x-cloak>
            <!-- Logo dan Judul -->
            <div class="flex items-center space-x-4 mb-10">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Selamat Datang!</h1>
                    <h1 class="py-3 text-gray-900">Silahkan Login Terlebih Dahulu</h1>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('message'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" wire:submit.prevent="login">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email Anda</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" required autocomplete="email"
                            class="block w-full rounded-full bg-gray-100 border border-gray-300
                            px-4 py-2 pr-12 text-sm text-gray-900 shadow-sm placeholder:text-gray-400
                            focus:border-blue-500 focus:ring-blue-500"
                            @error('email') border-red-500 @enderror" placeholder="Masukkan Email Anda..."
                            wire:model.defer="email">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>

                    <div class="relative mt-2">
                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                            autocomplete="current-password"
                            class="block w-full rounded-full bg-gray-100 border border-gray-300
                            px-4 py-2 pr-12 text-sm text-gray-900 shadow-sm placeholder:text-gray-400
                            focus:border-blue-500 focus:ring-blue-500"
                            @error('password') border-red-500 @enderror" placeholder="Masukkan Password Anda..."
                            wire:model.live.defer="password">

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
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" wire:model="remember"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Ingat saya
                    </label>
                </div>

                <!-- Tombol Login -->
                <div>
                    <button type="submit"
                        class="w-full rounded-full bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-3 my-2 text-white text-sm font-semibold shadow hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                        wire:loading.attr="disabled" wire:target="login">

                        <span wire:loading.remove wire:target="login">Masuk</span>

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
                </div>
            </form>
        </div>

        <!-- Kanan: Ilustrasi -->
        <div class="hidden md:flex items-center justify-center w-1/2 bg-white-100 p-8">
            <img src="{{ asset('img/kelurahan.jpg') }}" alt="Login Illustration" class="w-full max-w-md">
        </div>
    </div>
</div>
