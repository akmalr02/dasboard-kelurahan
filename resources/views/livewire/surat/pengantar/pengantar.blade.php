<div>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">{{ $title }}</h1>
        </div>
    </div>

    <div class="p-6">
        @if ($successMessage)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ $successMessage }}
            </div>
        @endif
        <div class="mb-3 flex items-start md:w-1/2">
            <a href="{{ route('create.pengantar') }}" wire:navigate
                class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Buat Surat Pengantar
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-100 text-left text-gray-700 font-semibold">
                        <th class="px-4 py-3 border-b text-center">No</th>
                        <th class="px-4 py-3 border-b text-center">Nama</th>
                        <th class="px-4 py-3 border-b text-center">NIK</th>
                        <th class="px-4 py-3 border-b text-center">Keperluan</th>
                        <th class="px-4 py-3 border-b text-center ">Status</th>
                        <th class="px-4 py-3 border-b text-center">Tanggal Pengajuan</th>
                        <th class="px-4 py-3 border-b text-center">RW</th>
                        <th class="px-4 py-3 border-b text-center">RT</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengantars as $index => $item)
                        <tr class="border-t hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 text-center">{{ $item->nama }}</td>
                            <td class="px-4 py-3 text-gray-600 text-center">{{ $item->NIK }}</td>
                            <td class="px-4 py-3 text-gray-700 text-center">{{ $item->keperluan }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold text-center
                            {{ $item->status === 'diproses'
                                ? 'bg-yellow-100 text-yellow-800'
                                : ($item->status === 'disetujui'
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 text-center">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 text-center">{{ $item->warga->rw->no_RW }}</td>
                            <td class="px-4 py-3 text-gray-600 text-center">{{ $item->warga->rt->no_RT }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Tombol Detail --}}
                                    <button wire:click="showDetail({{ $item->id_pengajuan }})"
                                        wire:loading.attr="disabled" wire:target="showDetail"
                                        class="px-3 py-1.5 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 transition-colors duration-200 flex items-center gap-1 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <x-heroicon-o-eye class="w-5 h-5" />
                                        <svg wire:loading wire:target="showDetail"
                                            class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4" />
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                        </svg>
                                        <span wire:loading.remove wire:target="showDetail">Detail</span>
                                        <span wire:loading wire:target="showDetail">Membuka...</span>
                                    </button>

                                    {{-- Tombol Edit --}}
                                    <button wire:click="showEdit({{ $item->id_pengajuan }})"
                                        wire:loading.attr="disabled" wire:target="showEdit"
                                        class="px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-md transition-colors duration-200 flex items-center gap-1 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <x-heroicon-o-pencil class="w-5 h-5" />
                                        <svg wire:loading wire:target="showEdit" class="w-4 h-4 animate-spin text-white"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4" />
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                        </svg>
                                        <span wire:loading.remove wire:target="showEdit">Edit</span>
                                        <span wire:loading wire:target="showEdit">Membuka...</span>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <button wire:click="showDelete({{ $item->id_pengajuan }})"
                                        wire:loading.attr="disabled" wire:target="showDelete"
                                        class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md transition-colors duration-200 flex items-center gap-1 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <x-heroicon-o-trash class="w-5 h-5" />
                                        <svg wire:loading wire:target="showDelete"
                                            class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4" />
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                        </svg>
                                        <span wire:loading.remove wire:target="showDelete">Hapus</span>
                                        <span wire:loading wire:target="showDelete">Membuka...</span>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-8">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="font-medium">Belum ada surat pengantar</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="space-y-4">
        @livewire('surat.pengantar.detail-pengantar')
        @livewire('surat.pengantar.edit-pengantar')
        @livewire('surat.pengantar.delet-pengantar')
    </div>
</div>
