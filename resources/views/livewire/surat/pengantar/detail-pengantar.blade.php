<x-modal wire:model="isOpen" maxWidth="max-w-4xl">
    <!-- Header -->
    <div class="flex justify-between items-center p-6 border-b">
        <div class="flex gap-3 items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Detail Surat Pengantar</h2>
                <p class="text-sm text-gray-500">Informasi lengkap pengajuan surat pengantar</p>
            </div>
        </div>
        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Content -->
    <div class="p-6">
        <!-- Data Pribadi -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Data Pribadi
                </span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <p class="text-gray-900 font-semibold">{{ data_get($surat, 'nama', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                    <p class="text-gray-900 font-mono">{{ data_get($surat, 'NIK', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <p class="text-gray-900">{{ data_get($surat, 'jenis_kelamin', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat/Tanggal Lahir</label>
                    <p class="text-gray-900">
                        {{ data_get($surat, 'tempat_lahir', '-') }}{{ data_get($surat, 'tanggal_lahir') ? ', ' . data_get($surat, 'tanggal_lahir') : '' }}
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                    <p class="text-gray-900">{{ data_get($surat, 'status_perkawinan', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">NKK</label>
                    <p class="text-gray-900 font-mono">{{ data_get($surat, 'NKK', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan</label>
                    <p class="text-gray-900">{{ data_get($surat, 'kewarganegaraan', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                    <p class="text-gray-900">{{ data_get($surat, 'agama', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                    <p class="text-gray-900">{{ data_get($surat, 'pekerjaan', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <p class="text-gray-900 break-all">{{ data_get($surat, 'email', '-') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <p class="text-gray-900">{{ data_get($surat, 'alamat', '-') }}</p>
                </div>
                @if (data_get($surat, 'file_pdf'))
                    <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Surat (PDF)</label>
                        <div class="flex gap-3 items-center">
                            <a href="{{ secure_asset('storage/' . data_get($surat, 'file_pdf')) }}" target="_blank"
                                class="px-4 py-2 text-sm text-white bg-green-600 rounded-lg hover:bg-green-700">
                                Lihat
                            </a>
                            <a href="{{ secure_asset('storage/' . data_get($surat, 'file_pdf')) }}" download
                                class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                                Download
                            </a>
                        </div>
                    </div>
                @endif

                @if (data_get($surat, 'foto_ktp'))
                    <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto KTP</label>
                        <div class="flex flex-col sm:flex-row gap-4 sm:items-center">
                            <img src="{{ secure_asset('storage/' . data_get($surat, 'foto_ktp')) }}" alt="Foto KTP"
                                class="w-32 h-auto rounded border border-gray-300">

                            <div class="flex gap-3">
                                <a href="{{ secure_asset('storage/' . data_get($surat, 'foto_ktp')) }}" target="_blank"
                                    class="px-4 py-2 text-sm text-white bg-green-600 rounded-lg hover:bg-green-700">
                                    Lihat
                                </a>
                                <a href="{{ secure_asset('storage/' . data_get($surat, 'foto_ktp')) }}" download
                                    class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">RW/RT</label>
                    <p class="text-gray-900">
                        {{ data_get($surat, 'pelapor.rw.no_RW', '-') }}/{{ data_get($surat, 'pelapor.rt.no_RT', '-') }}
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keperluan</label>
                    <p class="text-gray-900 font-semibold">{{ data_get($surat, 'keperluan', '-') }}</p>
                </div>
            </div>
        </div>

        <!-- Status & Tanggal -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Status & Tanggal
                </span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pengajuan</label>
                    @php
                        $status = data_get($surat, 'status');
                        $statusClass = match ($status) {
                            'diproses' => 'bg-yellow-100 text-yellow-800',
                            'disetujui' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-100 text-gray-800',
                        };
                    @endphp
                    <span
                        class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full {{ $statusClass }}">
                        {{ $status ? ucfirst($status) : 'Tidak diketahui' }}
                    </span>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengajuan</label>
                    <p class="text-gray-900">
                        @if (data_get($surat, 'tanggal_pengajuan'))
                            {{ \Carbon\Carbon::parse(data_get($surat, 'tanggal_pengajuan'))->format('d M Y') }}
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Kode Verifikasi -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
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
                            {{ data_get($surat, 'kode_verifikasi', '-') }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">QR Code</label>
                        <div class="bg-white p-3 rounded-lg border">
                            @if (data_get($surat, 'kode_verifikasi'))
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(data_get($surat, 'kode_verifikasi'), 'QRCODE') }}"
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Status RW -->
                    <div class="bg-white p-4 rounded-lg border">
                        <h4 class="font-semibold text-gray-900 mb-3">Tanda Tangan RW</h4>
                        @if (data_get($surat, 'file_ttd_rw'))
                            <div class="flex items-center space-x-3">
                                <div class="bg-white p-2 rounded border">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(secure_asset('storage/' . data_get($surat, 'file_ttd_rw')), 'QRCODE') }}"
                                        alt="QR RW" class="w-16 h-16">
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

                    <!-- Status RT -->
                    <div class="bg-white p-4 rounded-lg border">
                        <h4 class="font-semibold text-gray-900 mb-3">Tanda Tangan RT</h4>
                        @if (data_get($surat, 'file_ttd_rt'))
                            <div class="flex items-center space-x-3">
                                <div class="bg-white p-2 rounded border">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(secure_asset('storage/' . data_get($surat, 'file_ttd_rt')), 'QRCODE') }}"
                                        alt="QR RT" class="w-16 h-16">
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
                    @if (data_get($surat, 'file_ttd_rt') && data_get($surat, 'file_ttd_rw'))
                        <a href="{{ route('surat.download', ['jenis' => 'pengantar', 'id' => data_get($surat, 'id_pengajuan')]) }}"
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
                                Menunggu tanda tangan lengkap dari RT dan RW
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
