<div>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">{{ $title }}</h1>
        </div>
    </div>

    <div class="p-6">
        <!-- Table -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg p-2">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-100 text-left text-gray-700 font-semibold">
                        <th class="px-4 py-3 border-b">No</th>
                        <th class="px-4 py-3 border-b">Nama</th>
                        <th class="px-4 py-3 border-b">NIK</th>
                        <th class="px-4 py-3 border-b">Keperluan</th>
                        <th class="px-4 py-3 border-b">RW/RT</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Tanggal Pengajuan</th>
                        <th class="px-4 py-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengantars as $index => $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->nama }}</td>
                            <td class="px-4 py-3">{{ $item->NIK }}</td>
                            <td class="px-4 py-3">{{ $item->keperluan }}</td>
                            <td class="px-4 py-3">{{ $item->rw->no_RW ?? '-' }}/{{ $item->rt->no_RT ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-full text-sm font-semibold
                                    {{ $item->status === 'diproses'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : ($item->status === 'disetujui'
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <button wire:click="showDetail({{ $item->id_pengajuan }})"
                                    class=" px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    Lihat
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-6">Belum ada surat pengantar.</td>
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
                        <h2 class="text-2xl font-bold text-gray-900">Detail Surat Pengantar</h2>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                            &times;
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-3">
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    Data Pribadi
                                </span>
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                    <p class="text-gray-900 font-semibold">{{ $selectedSurat->nama }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                                    <p class="text-gray-900 font-mono">{{ $selectedSurat->NIK }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <p class="text-gray-900">{{ $selectedSurat->jenis_kelamin }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat/Tanggal
                                        Lahir</label>
                                    <p class="text-gray-900">{{ $selectedSurat->tempat_lahir }},
                                        {{ $selectedSurat->tanggal_lahir }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status
                                        Perkawinan</label>
                                    <p class="text-gray-900">{{ $selectedSurat->status_perkawinan }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NKK</label>
                                    <p class="text-gray-900 font-mono">{{ $selectedSurat->NKK }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan</label>
                                    <p class="text-gray-900">{{ $selectedSurat->kewarganegaraan }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <p class="text-gray-900">{{ $selectedSurat->agama }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                    <p class="text-gray-900">{{ $selectedSurat->pekerjaan }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-gray-900 break-all">{{ $selectedSurat->email }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <p class="text-gray-900">{{ $selectedSurat->alamat }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">RW/RT</label>
                                    <p class="text-gray-900">
                                        {{ $selectedSurat->pelapor->rw->no_RW ?? '-' }}/{{ $selectedSurat->pelapor->rt->no_RT ?? '-' }}
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Keperluan</label>
                                    <p class="text-gray-900 font-semibold">{{ $selectedSurat->keperluan }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600">Tanda Tangan RT</label>
                            @if ($selectedSurat->file_ttd_rt)
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-green-600">✅ Sudah Ditandatangani</span>
                                    <img src="{{ asset('storage/' . $selectedSurat->file_ttd_rt) }}" alt="TTD RT"
                                        class="h-16 border p-1 rounded">
                                </div>
                            @else
                                <span class="text-red-600">❌ Belum Ditandatangani</span>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600">Tanda Tangan RW</label>
                            @if ($selectedSurat->file_ttd_rw)
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-green-600">✅ Sudah Ditandatangani</span>
                                    <img src="{{ asset('storage/' . $selectedSurat->file_ttd_rw) }}" alt="TTD RW"
                                        class="h-16 border p-1 rounded">
                                </div>
                            @else
                                <span class="text-red-600">❌ Belum Ditandatangani</span>
                            @endif
                        </div>
                        @if (Auth::user()->role === 'pengelola_rw' && !$selectedSurat->file_ttd_rw)
                            <button x-data
                                x-on:click.prevent="if (confirm('Apakah Anda yakin ingin menandatangani surat ini?')) { $wire.ttdRw({{ $selectedSurat->id_pengajuan }}) }"
                                class="mr-3 px-6 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                                Tanda Tangani RW
                            </button>
                        @elseif (Auth::user()->role === 'pengelola_rt' && !$selectedSurat->file_ttd_rt)
                            <button x-data
                                x-on:click.prevent="if (confirm('Apakah Anda yakin ingin menandatangani surat ini?')) { $wire.ttdRt({{ $selectedSurat->id_pengajuan }}) }"
                                class="mr-3 px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                                Tanda Tangani RT
                            </button>
                        @endif
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
