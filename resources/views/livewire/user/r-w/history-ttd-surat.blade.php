<div>
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-6">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">{{ $title }}</h1>
            <p class="text-blue-100">Kelola dan pantau riwayat surat yang telah disetujui</p>
        </div>
    </div>

    <div class="p-6">
        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div class="relative w-full md:w-64">
                    <input type="text" wire:model.live.debounce.500ms="search"
                        placeholder="Cari nama, keperluan, atau email..."
                        class="w-full px-3 py-2 border rounded-lg pl-10 focus:ring focus:ring-blue-300 focus:border-blue-300 focus:outline-none">

                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    @if ($search)
                        <button wire:click="clearSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            type="button">
                            <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    @endif
                </div>

                <div class="text-sm text-gray-600">
                    Total: {{ $surats->total() }} surat
                </div>
            </div>
        </div>

        <div class="overflow-x-auto shadow border rounded-lg bg-white">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-blue-100 text-gray-700 font-semibold">
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Keperluan</th>
                        <th class="px-6 py-4 text-center">RT</th>
                        <th class="px-6 py-4 text-center">RW</th>
                        <th class="px-6 py-4 text-center">Tgl Disetujui</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($surats as $index => $surat)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $surats->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-left">
                                <div class="font-medium">{{ $surat->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $surat->email ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-left">{{ $surat->keperluan }}</td>
                            <td class="px-6 py-4 text-center">{{ $surat->rt?->no_RT ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">{{ $surat->rw?->no_RW ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($surat->tanggal_disetujui_rw)
                                    {{ \Carbon\Carbon::parse($surat->tanggal_disetujui_rw)->format('d M Y') }}
                                @elseif ($surat->tanggal_disetujui_rt)
                                    {{ \Carbon\Carbon::parse($surat->tanggal_disetujui_rt)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($surat->file_ttd_rw)
                                    <span class="text-green-800 bg-green-100 px-2 py-1 rounded-full text-xs">TTD
                                        RW</span>
                                @elseif ($surat->file_ttd_rt)
                                    <span class="text-yellow-800 bg-yellow-100 px-2 py-1 rounded-full text-xs">TTD
                                        RT</span>
                                @else
                                    <span
                                        class="text-gray-600 bg-gray-100 px-2 py-1 rounded-full text-xs">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="showDetail({{ $surat->id_pengajuan }})"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                @if ($search)
                                    Tidak ditemukan surat dengan kata kunci "{{ $search }}"
                                @else
                                    Belum ada surat pengantar yang ditandatangani
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($surats->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $surats->links() }}
                </div>
            @endif
        </div>

        <div class="space-y-4">
            @livewire('surat.pengantar.detail-pengantar')
        </div>

    </div>
</div>
