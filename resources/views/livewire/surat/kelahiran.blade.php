<div>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">{{ $title }}</h1>
        </div>
    </div>

    <div class="p-6">
        <div class="mb-3 flex items-start md:w-1/2">
            <a href="{{ route('create.kelahiran') }}" wire:navigate
                class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Buat Surat Kelahiran
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg p-2">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-100 text-left text-gray-700 font-semibold">
                        <th class="px-4 py-4 border-b">NO</th>
                        <th class="px-4 py-4 border-b">Nama Ayah</th>
                        <th class="px-4 py-4 border-b">Nama Ibu</th>
                        <th class="px-4 py-4 border-b">Nama Anak</th>
                        <th class="px-4 py-4 border-b">Jenis Kelamin</th>
                        <th class="px-4 py-4 border-b">Tanggal Lahir</th>
                        <th class="px-4 py-4 border-b">RW</th>
                        <th class="px-4 py-4 border-b">RT</th>
                        <th class="px-4 py-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suratKelahiran as $index => $surat)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $surat->ayah->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $surat->ibu->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $surat->nama_anak }}</td>
                            <td class="px-4 py-3">
                                {{ $surat->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3">{{ $surat->ayah->rw->no_RW ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $surat->ayah->rt->no_RT ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <button wire:click="showDetail({{ $surat->id_kelahiran }})"
                                    class=" px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">
                                Tidak ada data surat kelahiran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    @if ($showModal && $selectedSurat)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm"
            wire:click.self="closeModal">
            <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative"
                wire:click.stop>
                <!-- Header -->
                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-xl">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Detail Surat Kelahiran</h2>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                            &times;
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Anak</label>
                            <p class="text-gray-900">{{ $selectedSurat->nama_anak }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <p class="text-gray-900">
                                {{ $selectedSurat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <p class="text-gray-900">
                                {{ \Carbon\Carbon::parse($selectedSurat->tanggal_lahir)->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hari Lahir</label>
                            <p class="text-gray-900">{{ $selectedSurat->hari_lahir }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                            <p class="text-gray-900">{{ $selectedSurat->ayah->name ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                            <p class="text-gray-900">{{ $selectedSurat->ibu->name ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                            <p class="text-gray-900">{{ $selectedSurat->ayah->rt->no_RT ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                            <p class="text-gray-900">{{ $selectedSurat->ayah->rw->no_RW ?? '-' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Verifikasi</label>
                            <p class="text-gray-900 font-mono bg-gray-50 px-3 py-2 rounded border">
                                {{ $selectedSurat->kode_verifikasi }}
                            </p>
                            <!-- Barcode dari kode_verifikasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Barcode Kode
                                    Verifikasi</label>
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($selectedSurat->kode_verifikasi, 'QRCODE') }}"
                                    alt="Barcode Kode Verifikasi"
                                    class="border border-gray-300 bg-white p-2 rounded w-32 h-32">
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Tanda Tangan
                                Admin</label>
                            @if ($selectedSurat->file_ttd_admin)
                                <div class="flex flex-col space-y-6">
                                    <!-- Status dan Gambar TTD -->
                                    <div class="flex items-center space-x-3">
                                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(asset('storage/' . $surat->file_ttd_admin), 'QRCODE') }}"
                                            alt="QR TTD" class="w-32 h-32">
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Sudah Ditandatangani
                                        </span>
                                    </div>
                                    <!-- Tombol Download PDF -->
                                    <div>
                                        <a href="{{ route('surat.download', ['jenis' => 'kelahiran', 'id' => $selectedSurat->id_kelahiran]) }}"
                                            target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M3 3a1 1 0 011-1h4a1 1 0 010 2H5v12h10V4h-3a1 1 0 110-2h4a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V3z">
                                                </path>
                                                <path
                                                    d="M9 12a1 1 0 102 0V7a1 1 0 10-2 0v5zM7 10a1 1 0 102 0V7a1 1 0 10-2 0v3z">
                                                </path>
                                            </svg>
                                            Download PDF
                                        </a>
                                    </div>

                                </div>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Belum Ditandatangani
                                </span>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 rounded-b-xl border-t border-gray-200">
                    <div class="flex justify-end">
                        <button wire:click="closeModal"
                            class="px-6 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
