<div>
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3">
        <div class="max-w-7xl mx-auto px-2">
            <h1 class="text-3xl font-bold mb-2">User list</h1>
        </div>
    </div>
    <div class="p-6">
        <!-- Search Bar -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">

            <div wire:key="create-user-section" wire:ignore.self>
                <livewire:user.admin.create-user-controller wire:key="create-user-{{ now()->timestamp }}" />
            </div>
            <div class="flex items-center space-x-2">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari nama, atau e-mail..."
                        class="px-4 py-2 pl-10 pr-10 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64">
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
                            <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
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
                    <span class="text-blue-600">({{ $user->total() }} data ditemukan)</span>
                </p>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg p-2">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-100 text-left text-gray-700 font-semibold">
                        <th class="px-4 py-4 border-b">No</th>
                        <th class="px-4 py-4 border-b">Nama</th>
                        <th class="px-4 py-4 border-b">E-mail</th>
                        <th class="px-4 py-4 border-b">Peran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $index => $q)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3 border-b">
                                {{ $loop->iteration + ($user->currentPage() - 1) * $user->perPage() }}
                            </td>
                            <td class="px-4 py-3 border-b">{{ $q->name }}</td>
                            <td class="px-4 py-3 border-b">{{ $q->email }}</td>
                            <td class="px-4 py-3 border-b">{{ $q->role }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 border-b text-center text-gray-500">
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
                                        <p class="text-lg font-medium text-gray-900 mb-2">Belum ada data user</p>
                                        <p class="text-gray-500">Data user akan ditampilkan di sini</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($user->hasPages())
            <div class="mt-6 flex justify-between items-center">
                <div class="text-lg text-gray-700">
                    Menampilkan {{ $user->firstItem() }} sampai {{ $user->lastItem() }}
                    dari {{ $user->total() }} data
                </div>
                <div>
                    {{ $user->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @endif
    </div>
</div>
