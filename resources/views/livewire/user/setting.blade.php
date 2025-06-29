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
                            <button class="ml-3 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                                wire:click="$emit('editName')" title="Edit Nama">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                            <button class="ml-3 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                                wire:click="$emit('editEmail')" title="Edit Email">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>
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
                        @if (Auth::user()->role === 'warga')
                            Foto Profil
                        @else
                            Foto & Tanda Tangan
                        @endif
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @auth
                        <!-- Foto Profil -->
                        <div class="space-y-4">
                            <label class="text-sm font-medium text-gray-500">Foto Profil</label>
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-24 h-24 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                                    @if ($user->foto_profil)
                                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil"
                                            class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <button
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                                        wire:click="$emit('uploadFotoProfil')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        {{ $user->foto_profil ? 'Ganti' : 'Upload' }} Foto
                                    </button>
                                    @if ($user->foto_profil)
                                        <button
                                            class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                            wire:click="$emit('hapusFotoProfil')">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">Format: JPG, PNG, max 2MB</p>
                        </div>
                        @if (Auth::user()->role !== 'warga')
                            <!-- Tanda Tangan Digital -->
                            <div class="space-y-4">
                                <label class="text-sm font-medium text-gray-500">Tanda Tangan Digital</label>
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-32 h-16 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                                        @if ($user->ttd_digital)
                                            <img src="{{ asset('storage/' . $user->ttd_digital) }}" alt="Tanda Tangan"
                                                class="w-full h-full object-contain rounded-lg">
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex flex-col space-y-2">
                                        <button
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                                            wire:click="$emit('uploadTandaTangan')">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            {{ $user->ttd_digital ? 'Ganti' : 'Upload' }} TTD
                                        </button>
                                        @if ($user->ttd_digital)
                                            <button
                                                class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                                wire:click="$emit('hapusTandaTangan')">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                Hapus
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500">Format: JPG, PNG, max 1MB</p>
                            </div>
                        @endif
                    @endauth

                </div>
            </div>

            <!-- Warga Information Section -->
            @if ($warga)
                <div class="p-8 border-b border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaturan Keamanan</h3>
                <button
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-200"
                    wire:click="$emit('openPasswordModal')">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                        </path>
                    </svg>
                    Ganti Password
                </button>
            </div>
        </div>
    </div>
</div>
