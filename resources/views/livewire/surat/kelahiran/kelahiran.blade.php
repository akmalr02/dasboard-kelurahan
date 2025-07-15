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
            <a href="{{ route('create.kelahiran') }}" wire:navigate
                class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Buat Surat Kelahiran
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-100 text-left text-gray-700 font-semibold">
                        <th class="px-4 py-3 border-b text-center">No</th>
                        <th class="px-4 py-3 border-b text-center">Nama Ayah</th>
                        <th class="px-4 py-3 border-b text-center">Nama Ibu</th>
                        <th class="px-4 py-3 border-b text-center">Nama Anak</th>
                        <th class="px-4 py-3 border-b text-center">Jenis Kelamin</th>
                        <th class="px-4 py-3 border-b text-center">Tanggal Lahir</th>
                        <th class="px-4 py-3 border-b text-center">RW</th>
                        <th class="px-4 py-3 border-b text-center">RT</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suratKelahiran as $index => $surat)
                        <tr class="border-t hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 text-center">{{ $surat->ayah->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 text-center">{{ $surat->ibu->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 font-semibold text-center">{{ $surat->nama_anak }}</td>
                            <td class="px-4 py-3 text-center">
                                <span
                                    class="px-2 py-1 rounded-full text-sm font-medium
                            {{ $surat->jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $surat->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-600">
                                <span
                                    class="font-mono">{{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md text-sm font-medium">
                                    {{ $surat->ayah->rw->no_RW ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md text-sm font-medium">
                                    {{ $surat->ayah->rt->no_RT ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Tombol Detail --}}
                                    <button wire:click="showDetail({{ $surat->id_kelahiran }})"
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
                                    <button wire:click="showEdit({{ $surat->id_kelahiran }})"
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
                                    <button wire:click="showDelete({{ $surat->id_kelahiran }})"
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
                            <td colspan="9" class="text-center text-gray-500 py-8">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                    <span class="font-medium">Tidak ada data surat kelahiran</span>
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
        @livewire('surat.kelahiran.detail-kelahiran')
        @livewire('surat.kelahiran.edit-kelahiran')
        @livewire('surat.kelahiran.delet-kelahiran')
    </div>
</div>
