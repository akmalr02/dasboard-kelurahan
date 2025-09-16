<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <h1 class="text-2xl font-semibold text-gray-900">Anggota Keluarga</h1>
            <p class="text-gray-600 mt-1">Lihat informasi anggota keluarga</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($keluarga as $k)
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start gap-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $k->name }}</h3>

                            <div class="mt-3 space-y-2 text-sm">
                                <div class="flex">
                                    <span class="text-gray-500 w-32">NKK:</span>
                                    <span class="text-gray-900 font-mono">{{ $k->NKK }}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 w-32">NIK:</span>
                                    <span class="text-gray-900 font-mono">{{ $k->NIK }}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 w-32">Status Keluarga:</span>
                                    <span class="text-gray-900 font-mono">{{ $k->status_keluarga }}</span>
                                </div>
                                <div class="flex">
                                    <span class="text-gray-500 w-32">Kewarganegaraan:</span>
                                    <span class="text-gray-900 font-mono">{{ $k->kewarganegaraan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                        <button wire:click.prevent="showDetail({{ $k->id_warga }})"
                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Lihat
                            Detail</button>
                    </div>
                </div>
            @endforeach
            <!-- Modal Detail -->
            @if ($showModal && $selectedWarga)
                <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
                        <!-- Header -->
                        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-xl">
                            <div class="flex items-center justify-between">
                                <h2 class="text-2xl font-bold text-gray-900">Detail Keluarga</h2>
                                <button wire:click="closeModal"
                                    class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Profile Section -->
                            <div class="flex flex-col items-center mb-8">
                                <div class="relative">
                                    <img class="w-24 h-24 rounded-full object-cover border-4 border-gray-100 shadow-lg"
                                        src="{{ $selectedWarga->foto_profil ? asset('storage/' . $selectedWarga->foto_profil) : asset('img/user.jpg') }}"
                                        alt="foto_profil {{ $selectedWarga->name }}">
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mt-4">{{ $selectedWarga->name }}</h3>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                                    {{ ucfirst(str_replace('_', ' ', $selectedWarga->status_keluarga)) }}
                                </span>
                            </div>

                            <!-- Information Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Identitas -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                        Identitas</h4>

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">NIK</span>
                                            <span
                                                class="text-sm text-gray-900 font-mono">{{ $selectedWarga->NIK }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">NKK</span>
                                            <span
                                                class="text-sm text-gray-900 font-mono">{{ $selectedWarga->NKK }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Jenis Kelamin</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Kewarganegaraan</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->kewarganegaraan }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Agama</span>
                                            <span class="text-sm text-gray-900">{{ $selectedWarga->agama }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Personal Info -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                        Informasi Personal</h4>

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Tempat Lahir</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->tempat_lahir ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Tanggal Lahir</span>
                                            <span class="text-sm text-gray-900">
                                                {{ $selectedWarga->tanggal_lahir ? \Carbon\Carbon::parse($selectedWarga->tanggal_lahir)->format('d M Y') : '-' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Umur</span>
                                            <span class="text-sm text-gray-900">
                                                {{ $selectedWarga->tanggal_lahir ? \Carbon\Carbon::parse($selectedWarga->tanggal_lahir)->age . ' tahun' : '-' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Golongan Darah</span>
                                            <span
                                                class="text-sm text-gray-900">{{ ucfirst($selectedWarga->golongan_darah) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Status Perkawinan</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->status_perkawinan }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pendidikan & Pekerjaan -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                        Pendidikan & Pekerjaan</h4>

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Pendidikan</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->pendidikan ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Pekerjaan</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->pekerjaan ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat & Wilayah -->
                                <div class="space-y-4">
                                    <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                                        Alamat & Wilayah</h4>

                                    <div class="space-y-3">
                                        <div class="py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600 block mb-1">Alamat</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->alamat ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">RT</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->rt?->no_RT ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">RW</span>
                                            <span
                                                class="text-sm text-gray-900">{{ $selectedWarga->rw?->no_RW ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Section -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Status</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                            {{ $selectedWarga->status_penduduk == 'hidup'
                                ? 'bg-green-100 text-green-800'
                                : ($selectedWarga->status_penduduk == 'pindah'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($selectedWarga->status_penduduk) }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($selectedWarga->role) }}
                                    </span>
                                </div>

                                @if ($selectedWarga->status_penduduk == 'meninggal' && $selectedWarga->tanggal_meninggal)
                                    <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                        <span class="text-sm font-medium text-gray-600">Tanggal Meninggal: </span>
                                        <span class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($selectedWarga->tanggal_meninggal)->format('d M Y') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="sticky bottom-0 bg-gray-50 px-6 py-4 rounded-b-xl border-t border-gray-200">
                            <div class="flex justify-end space-x-3">
                                <button wire:click="closeModal"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
