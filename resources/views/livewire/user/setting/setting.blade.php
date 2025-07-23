<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Pengaturan Akun</h1>
            <p class="text-white">Kelola informasi akun dan profil Anda</p>
        </div>
    </div>
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-8 border-b border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Pengguna</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500">Nama</label>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500">Role</label>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
            </div>
            <!-- Foto Profil & Tanda Tangan Section -->
            <div class="p-8 border-b border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">
                        Foto & Tanda Tangan
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @auth
                        <!-- Foto Profil -->
                        <div class="space-y-4">
                            @livewire('user.setting.foto-setting-form')
                        </div>

                        <!-- Tanda Tangan Digital -->
                        <div class="space-y-4">
                            @livewire('user.setting.ttd-setting-form')
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Warga Information Section -->
            @if ($warga)
                <div class="p-8 border-b border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2m-6 4h.01M16 11h.01"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Informasi Warga</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">NIK</label>
                            <p class="text-gray-900 font-medium">{{ $warga->NIK }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="text-gray-900 font-medium">{{ $warga->name }}</p>
                        </div>
                        <div class="space-y-1 md:col-span-3">
                            <label class="text-sm font-medium text-gray-500">Alamat</label>
                            <p class="text-gray-900 font-medium">{{ $warga->alamat }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">RT/RW</label>
                            <p class="text-gray-900 font-medium">
                                {{ $warga->rt?->no_RT ?? '-' }}/{{ $warga->rw?->no_RW ?? '-' }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Status Penduduk</label>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                {{ ucfirst($warga->status_penduduk) }}
                            </span>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-8 border-b bor-gray-100">
                    <div class="flex items-center p-4 bg-red-400 rounded-lg">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-900 font-medium">Akun Administrator</p>
                            <p class="text-gray-600 text-sm">Anda masuk sebagai admin sistem</p>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Actions Section -->
            <div class="p-8">
                @livewire('user.setting.password-setting-form')
            </div>
        </div>
    </div>
</div>
