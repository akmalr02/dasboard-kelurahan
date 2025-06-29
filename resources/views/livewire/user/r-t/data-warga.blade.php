<div>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Dashboard Ketua RT</h1>
        </div>
    </div>
    <div class="p-6">
        <!-- Search Bar -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Data Warga</h2>

            <button wire:click="downloadDataRT" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Download Data RT {{ Auth::user()->id_rt }}
            </button>


            <div class="flex items-center space-x-2">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.500ms="search"
                        placeholder="Cari nama, NIK, atau NKK..."
                        class="px-4 py-2 pl-10 pr-10 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64">
                    <!-- Search Icon -->
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        {{-- gunakan dari bladee ui --}}
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Clear Button -->
                    @if ($search)
                        <button wire:click="clearSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            type="button">
                            <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div wire:loading.delay wire:target="search" class="mb-4">
            <div class="flex items-center text-blue-600">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Mencari data...
            </div>
        </div>

        <!-- Search Results Info -->
        @if ($search)
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-blue-700">
                    Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                    <span class="text-blue-600">({{ $warga->total() }} data ditemukan)</span>
                </p>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg p-2">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-100 text-left text-gray-700 font-semibold">
                        <th class="px-4 py-4 border-b">NO</th>
                        <th class="px-4 py-4 border-b">NKK</th>
                        <th class="px-4 py-4 border-b">NIK</th>
                        <th class="px-4 py-4 border-b">Nama</th>
                        <th class="px-4 py-4 border-b">RW</th>
                        <th class="px-4 py-4 border-b">RT</th>
                        <th class="px-4 py-4 border-b">Jenis Kelamin</th>
                        <th class="px-4 py-4 border-b">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wargas as $index => $w)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3 border-b">
                                {{ $loop->iteration + ($wargas->currentPage() - 1) * $wargas->perPage() }}
                            </td>
                            <td class="px-4 py-3 border-b">{{ $w->NKK }}</td>
                            <td class="px-4 py-3 border-b">{{ $w->NIK }}</td>
                            {{-- <td class="px-4 py-3 border-b">{{ $w->name }}</td> --}}
                            <td class="px-4 py-3 border-b font-medium">
                                @if ($search)
                                    {!! str_ireplace($search, '<mark class="bg-yellow-200">' . $search . '</mark>', $w->name) !!}
                                @else
                                    {{ $w->name }}
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b">{{ $w->id_RW }}</td>
                            <td class="px-4 py-3 border-b">{{ $w->id_RT }}</td>
                            <td class="px-4 py-3 border-b">
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full 
                                {{ $w->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b">{{ $w->alamat }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 border-b text-center text-gray-500">
                                @if ($search)
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <p class="text-lg font-medium text-gray-900 mb-2">Tidak ada data ditemukan</p>
                                        <p class="text-gray-500">Coba ubah kata kunci pencarian Anda</p>
                                        <button wire:click="clearSearch"
                                            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-150">
                                            Hapus Pencarian
                                        </button>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        <p class="text-lg font-medium text-gray-900 mb-2">Belum ada data warga</p>
                                        <p class="text-gray-500">Data warga akan ditampilkan di sini</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($wargas->hasPages())
            <div class="mt-6 flex justify-between items-center">
                <div class="text-lg text-gray-700">
                    Menampilkan {{ $wargas->firstItem() }} sampai {{ $wargas->lastItem() }}
                    dari {{ $wargas->total() }} data
                </div>
                <div>
                    {{ $wargas->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @endif
    </div>
</div>
