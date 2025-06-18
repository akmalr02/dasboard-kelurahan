<nav class="bg-sky-500" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between w-full">
            <!-- Kiri: Logo -->
            <div class="flex items-center">
                @auth
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-2">
                            <img class="w-10 h-10" src="{{ asset('img/logo.png') }}" alt="Logo Kelurahan">
                            <span class="text-white font-semibold text-base">Kelurahan Kramat</span>
                        </a>
                    @elseif (Auth::user()->role == 'pengelola_rw')
                        <a href="{{ route('rw.dashboard') }}" wire:navigate class="flex items-center gap-2">
                            <img class="w-10 h-10" src="{{ asset('img/logo.png') }}" alt="Logo Kelurahan">
                            <span class="text-white font-semibold text-base">Kelurahan Kramat</span>
                        </a>
                    @elseif (Auth::user()->role == 'pengelola_rt')
                        <a href="{{ route('rt.dashboard') }}" wire:navigate class="flex items-center gap-2">
                            <img class="w-10 h-10" src="{{ asset('img/logo.png') }}" alt="Logo Kelurahan">
                            <span class="text-white font-semibold text-base">Kelurahan Kramat</span>
                        </a>
                    @elseif (Auth::user()->role == 'warga')
                        <a href="{{ route('warga.dashboard') }}" wire:navigate class="flex items-center gap-2">
                            <img class="w-10 h-10" src="{{ asset('img/logo.png') }}" alt="Logo Kelurahan">
                            <span class="text-white font-semibold text-base">Kelurahan Kramat</span>
                        </a>
                    @endif
                @else
                    <a href="{{ route('welcome') }}" wire:navigate class="flex items-center gap-2">
                        <img class="w-10 h-10" src="{{ asset('img/logo.png') }}" alt="Logo Kelurahan">
                        <span class="text-white font-semibold text-base">Kelurahan Kramat</span>
                    </a>
                @endauth
            </div>

            <!-- Tengah: Menu Desktop -->
            <div class="hidden md:flex items-center justify-center flex-1">
                @auth
                    @if (Auth::user()->role == 'admin')
                        {{-- Data User dan Surat --}}
                        <div class="flex items-center gap-4 relative" x-data="{ openSurat: false }">
                            <a href="{{ route('admin.index') }}" wire:navigate
                                class="{{ request()->routeIs('admin.index') ? 'bg-sky-600 text-white' : 'text-white hover:bg-sky-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
                                Data User
                            </a>
                            <button @click="openSurat = !openSurat"
                                class="text-white hover:bg-sky-700 rounded-md px-3 py-2 text-sm font-medium flex items-center gap-1">
                                <span>Surat</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openSurat" @click.outside="openSurat = false" x-transition
                                class="absolute top-full mt-2 bg-white w-48 rounded-md shadow-lg z-50">
                                <a href="#" wire:navigate
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat
                                    Kelahiran</a>
                                <a href="#" wire:navigate
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Surat
                                    Kematian</a>
                            </div>
                        </div>
                    @elseif (Auth::user()->role == 'pengelola_rw')
                        <a href="#" wire:navigate
                            class="text-white hover:bg-sky-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                            Halaman Pengelola RW
                        </a>
                    @elseif (Auth::user()->role == 'pengelola_rt')
                        <a href="#" wire:navigate
                            class="text-white hover:bg-sky-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                            Halaman Pengelola RT
                        </a>
                    @elseif (Auth::user()->role == 'warga')
                        <a href="#" wire:navigate
                            class="text-white hover:bg-sky-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                            Halaman Warga
                        </a>
                    @endif
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('index') }}" wire:navigate
                            class="{{ request()->routeIs('index') ? 'bg-sky-600 text-white' : 'text-white hover:bg-sky-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
                            <span class="font-semibold text-base">Kependudukan</span>
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Kanan: Tombol Login/User Menu Desktop -->
            <div class="hidden md:flex items-center">
                @if (Auth::check())
                    <div class="relative" x-data="{ openUser: false }">
                        <button @click="openUser = !openUser"
                            class="text-white hover:bg-sky-700 rounded-md px-3 py-2 text-sm font-medium flex items-center gap-1">
                            <x-simpleline-user class="w-5 h-5" />
                            <span class="font-semibold text-base">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openUser" @click.outside="openUser = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My
                                Akun</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Setting</a>
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" wire:navigate
                        class="{{ request()->routeIs('login') ? 'bg-sky-600 text-white' : 'text-white hover:bg-sky-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium flex items-center gap-1">
                        <x-simpleline-login class="w-5 h-5" />
                        <span class="font-semibold text-base">Login</span>
                    </a>
                @endif
            </div>

            <!-- Tombol Mobile Menu -->
            <div class="md:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center rounded-md bg-sky-600 p-2 text-white hover:bg-sky-700">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div x-show="open" x-transition.duration.200ms class="md:hidden px-2 pt-2 pb-3 space-y-1">
        <a href="{{ route('welcome') }}" wire:navigate
            class="block {{ request()->routeIs('welcome') ? 'bg-sky-600 text-white' : 'text-white hover:bg-sky-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
            <span>Dashboard</span>
        </a>
        <a href="{{ route('index') }}" wire:navigate
            class="block {{ request()->routeIs('index') ? 'bg-sky-600 text-white' : 'text-white hover:bg-sky-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">
            <span>Kependudukan</span>
        </a>

        @if (Auth::check())
            <div x-data="{ mobileUserOpen: false }" class="relative">
                <button @click="mobileUserOpen = !mobileUserOpen"
                    class="w-full text-white hover:bg-sky-700 rounded-md px-3 py-2 text-sm font-medium flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <x-simpleline-user class="w-5 h-5" />
                        <span class="font-semibold text-base">{{ Auth::user()->name }}</span>
                    </div>
                    <svg class="w-4 h-4 transform" :class="mobileUserOpen ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="mobileUserOpen" x-transition class="mt-2 bg-white rounded-md shadow-md w-full z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Akun</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Setting</a>
                    <a href="{{ route('logout') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" wire:navigate
                class="{{ request()->routeIs('login') ? 'bg-sky-600 text-white' : 'text-white hover:bg-sky-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium flex items-center gap-1">
                <x-simpleline-login class="w-5 h-5" />
                <span class="font-semibold text-base">Login</span>
            </a>
        @endif
    </div>
</nav>
