<x-modal wire:model="isOpen" maxWidth="max-w-4xl">
    <!-- Header -->
    <div class="flex justify-between items-center p-6 border-b">
        <div class="flex gap-3 items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Detail Surat Kematian</h2>
                <p class="text-sm text-gray-500">Informasi lengkap surat kematian</p>
            </div>
        </div>
        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Body -->
    <div class="p-6">
        <!-- Data Almarhum -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Data Almarhum
                </span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Almarhum</label>
                    <p class="text-gray-900 font-semibold">{{ data_get($selectedSurat, 'nama_warga', '-') }}
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <p class="text-gray-900">
                        {{ data_get($selectedSurat, 'jenis_kelamin') == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <p class="text-gray-900">{{ data_get($selectedSurat, 'tempat_lahir', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <p class="text-gray-900">
                        @if (data_get($selectedSurat, 'tanggal_lahir'))
                            {{ \Carbon\Carbon::parse(data_get($selectedSurat, 'tanggal_lahir'))->format('d M Y') }}
                        @else
                            -
                        @endif
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">RW/RT</label>
                    <p class="text-gray-900">
                        {{ data_get($selectedSurat, 'pelapor.rw.no_RW', '-') }}/{{ data_get($selectedSurat, 'pelapor.rt.no_RT', '-') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Data Kematian -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Data Kematian
                </span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hari Meninggal</label>
                    <p class="text-gray-900 font-semibold">
                        {{ data_get($selectedSurat, 'hari_meninggal', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Meninggal</label>
                    <p class="text-gray-900">
                        @if (data_get($selectedSurat, 'tanggal_meninggal'))
                            {{ \Carbon\Carbon::parse(data_get($selectedSurat, 'tanggal_meninggal'))->format('d M Y') }}
                        @else
                            -
                        @endif
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jam Meninggal</label>
                    <p class="text-gray-900">{{ data_get($selectedSurat, 'jam_meninggal', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penyebab Kematian</label>
                    <p class="text-gray-900">{{ data_get($selectedSurat, 'penyebab', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Pemakaman</label>
                    <p class="text-gray-900">{{ data_get($selectedSurat, 'tempat_pemakaman', '-') }}</p>
                </div>
            </div>
        </div>

        <!-- Kode Verifikasi -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Kode Verifikasi
                </span>
            </h3>
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
                    <div class="mb-4 md:mb-0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Verifikasi</label>
                        <p class="text-gray-900 font-mono bg-white px-4 py-2 rounded border text-lg">
                            {{ data_get($selectedSurat, 'kode_verifikasi', '-') }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">QR Code</label>
                        <div class="bg-white p-3 rounded-lg border">
                            @if (data_get($selectedSurat, 'kode_verifikasi'))
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(data_get($selectedSurat, 'kode_verifikasi'), 'QRCODE') }}"
                                    alt="QR Code Verifikasi" class="w-24 h-24">
                            @else
                                <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No QR</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Tanda Tangan -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Status Tanda Tangan
                </span>
            </h3>
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Status Admin -->
                    <div class="bg-white p-4 rounded-lg border">
                        <h4 class="font-semibold text-gray-900 mb-3">Tanda Tangan Admin</h4>
                        @if (data_get($selectedSurat, 'file_ttd_admin'))
                            <div class="flex items-center space-x-3">
                                <div class="bg-white p-2 rounded border">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(secure_asset('storage/' . data_get($selectedSurat, 'file_ttd_admin')), 'QRCODE') }}"
                                        alt="QR Admin" class="w-16 h-16">
                                </div>
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Sudah Ditandatangani
                                </span>
                            </div>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Belum Ditandatangani
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Download Button -->
                <div class="mt-6 text-center">
                    @if (data_get($selectedSurat, 'file_ttd_admin'))
                        <a href="{{ route('surat.download', ['jenis' => 'kematian', 'id' => data_get($selectedSurat, 'id_kematian')]) }}"
                            target="_blank"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Download Surat PDF
                        </a>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-red-800 font-medium">Surat belum dapat didownload</span>
                            </div>
                            <p class="text-red-600 text-sm mt-2 text-center">
                                Menunggu tanda tangan dari Admin
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="flex justify-end items-center gap-3 p-6 border-t bg-gray-50">
        <button wire:click="closeModal"
            class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Tutup</button>
    </div>
</x-modal>
