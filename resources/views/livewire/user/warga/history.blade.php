<div>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-6">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">{{ $title }}</h1>
            <p class="text-blue-100">Kelola dan pantau riwayat surat yang telah disetujui</p>
        </div>
    </div>

    <div class="p-6">
        <!-- Filter Jenis Surat -->
        <div class="mb-6">
            <div class="flex flex-wrap gap-2">
                <button wire:click="$set('jenis', 'pengantar')"
                    class="px-4 py-2 rounded-lg font-medium transition-colors {{ $jenis === 'pengantar' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Surat Pengantar
                </button>
                <button wire:click="$set('jenis', 'kelahiran')"
                    class="px-4 py-2 rounded-lg font-medium transition-colors {{ $jenis === 'kelahiran' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Surat Kelahiran
                </button>
                <button wire:click="$set('jenis', 'kematian')"
                    class="px-4 py-2 rounded-lg font-medium transition-colors {{ $jenis === 'kematian' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Surat Kematian
                </button>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="search..."
                            class="px-2 py-2 pl-10 pr-10 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64">

                        <!-- Search Icon -->
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Clear Button -->
                        @if ($search)
                            <button wire:click="clearSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                type="button">
                                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Info Counter -->
                <div class="text-sm text-gray-600">
                    Total: {{ $surats->total() }} surat
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg bg-white">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-blue-100 text-gray-700 font-semibold">
                        <th class="px-6 py-4 border-b text-center w-16">No</th>

                        @if ($jenis === 'pengantar')
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Nama</th>
                            <th class="px-6 py-4 border-b text-left min-w-[250px]">Keperluan</th>
                            <th class="px-6 py-4 border-b text-center w-20">RT</th>
                            <th class="px-6 py-4 border-b text-center w-20">RW</th>
                            <th class="px-6 py-4 border-b text-center min-w-[160px]">Tgl Disetujui</th>
                            <th class="px-6 py-4 border-b text-center min-w-[120px]">Status</th>
                        @elseif ($jenis === 'kelahiran')
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Nama Anak</th>
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Nama Ayah</th>
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Nama Ibu</th>
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Tempat / Tgl Lahir</th>
                            <th class="px-6 py-4 border-b text-center min-w-[160px]">Tgl Disetujui</th>
                        @elseif ($jenis === 'kematian')
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Nama Almarhum</th>
                            <th class="px-6 py-4 border-b text-left min-w-[150px]">Jenis Kelamin</th>
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Tgl Meninggal</th>
                            <th class="px-6 py-4 border-b text-left min-w-[200px]">Sebab Meninggal</th>
                            <th class="px-6 py-4 border-b text-center min-w-[160px]">Tgl Disetujui</th>
                        @endif

                        <th class="px-6 py-4 border-b text-center min-w-[150px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($surats as $index => $surat)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 text-center">
                                {{ $surats->firstItem() + $index }}
                            </td>

                            @if ($jenis === 'pengantar')
                                <td class="px-6 py-4 text-left">
                                    <div class="font-medium text-gray-900">{{ $surat->nama }}</div>
                                    <div class="text-sm text-gray-500">E-mail:
                                        {{ $surat->email ?? 'Email tidak tersedia' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-left">
                                    <div class="text-sm">{{ $surat->keperluan }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $surat->rt?->no_RT ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $surat->rw?->no_RW ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($surat->tanggal_disetujui_rw)
                                        {{ \Carbon\Carbon::parse($surat->tanggal_disetujui_rw)->format('d M Y') }}
                                    @elseif ($surat->tanggal_disetujui_rt)
                                        {{ \Carbon\Carbon::parse($surat->tanggal_disetujui_rt)->format('d M Y') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($surat->file_ttd_rw)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            TTD RW
                                        </span>
                                    @elseif ($surat->file_ttd_rt)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            TTD RT
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            @elseif ($jenis === 'kelahiran')
                                <td class="px-6 py-4 text-left">
                                    <div class="font-medium text-gray-900">{{ $surat->nama_anak }}</div>
                                    <div class="text-sm text-gray-500">
                                        Jenis Kelamin: {{ $surat->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-left">{{ $surat->ayah->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-left">{{ $surat->ibu->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-left">
                                    <div>{{ $surat->tempat_lahir }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($surat->updated_at)->format('d M Y') }}
                                </td>
                            @elseif ($jenis === 'kematian')
                                <td class="px-6 py-4 text-left">
                                    <div class="font-medium text-gray-900">{{ $surat->nama_warga }}</div>
                                    @php
                                        $umur = null;
                                        if ($surat->tanggal_lahir && $surat->tanggal_meninggal) {
                                            $umur = \Carbon\Carbon::parse($surat->tanggal_lahir)->diffInYears(
                                                $surat->tanggal_meninggal,
                                            );
                                        }
                                    @endphp
                                    <div class="text-sm text-gray-500">Umur: {{ $umur ? "$umur tahun" : '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-lef">
                                    {{ $surat->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="px-6 py-4 text-left">
                                    {{ \Carbon\Carbon::parse($surat->tanggal_meninggal)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-left">{{ $surat->penyebab ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($surat->updated_at)->format('d M Y') }}
                                </td>
                            @endif

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button
                                        wire:click="showDetail({{ $jenis === 'pengantar'
                                            ? $surat->id_pengajuan
                                            : ($jenis === 'kelahiran'
                                                ? $surat->id_kelahiran
                                                : $surat->id_kematian) }})"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md text-sm flex items-center gap-1 transition-colors">
                                        <x-heroicon-o-eye class="w-5 h-5" />
                                        <span>Detail</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $jenis === 'pengantar' ? '7' : '6' }}" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data</h3>
                                    <p class="text-gray-500">
                                        @if ($search)
                                            Tidak ditemukan surat dengan kata kunci "{{ $search }}"
                                        @else
                                            Belum ada surat {{ $jenis }} yang ditandatangani
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @include('livewire.user.admin.detail-surat')
            <!-- Pagination -->
            @if ($surats->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $surats->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
