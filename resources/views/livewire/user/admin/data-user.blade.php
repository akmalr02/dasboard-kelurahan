<div>
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">User List</h1>
        </div>
    </div>
    <div class="p-6">
        <!-- Search Bar -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">

            <div wire:key="create-user-section" wire:ignore.self>
                <livewire:user.admin.create-user-controller wire:key="create-user" />
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

        @if ($successMessage)
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded-lg text-sm transition-all duration-500">
                {{ $successMessage }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto shadow-lg border border-gray-200 rounded-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-blue-100 text-gray-700 font-semibold">
                        <th class="px-6 py-4 border-b text-center w-16">No</th>
                        <th class="px-6 py-4 border-b text-left min-w-[200px]">Nama</th>
                        <th class="px-6 py-4 border-b text-left min-w-[250px]">E-mail</th>
                        <th class="px-6 py-4 border-b text-center min-w-[120px]">Role</th>
                        <th class="px-6 py-4 border-b text-center w-20">RW</th>
                        <th class="px-6 py-4 border-b text-center w-20">RT</th>
                        <th class="px-6 py-4 border-b text-center min-w-[200px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($user as $index => $q)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 text-center text-sm text-gray-900">
                                {{ $loop->iteration + ($user->currentPage() - 1) * $user->perPage() }}
                            </td>
                            <td class="px-6 py-4 text-left">
                                <div class="text-sm font-medium text-gray-900">{{ $q->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-left">
                                <div class="text-sm text-gray-600">{{ $q->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">{{ $q->role }}</td>
                            <td class="px-6 py-4 text-center text-sm text-gray-900">
                                {{ $q->id_rw ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-900">
                                {{ $q->id_rt ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <!-- Tombol Detail -->
                                    <button wire:click="$dispatch('showUserDetail', { id_user: '{{ $q->id_user }}' })"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md transition-colors duration-200 flex items-center gap-1">
                                        Detail
                                    </button>
                                    <button wire:click="$dispatch('editUser', { id_user: '{{ $q->id_user }}' })"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md transition-colors duration-200 flex items-center gap-1">
                                        Edit
                                    </button>
                                    <button
                                        wire:click="$dispatch('confirmDeleteUser', { id_user: '{{ $q->id_user }}' })"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md transition-colors duration-200 flex items-center gap-1">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data</h3>
                                    <p class="text-gray-500">Belum ada user yang terdaftar dalam sistem</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div wire:key="detail-user-section">
                <livewire:user.admin.detail-user-controller />
            </div>
            <div wire:key="edit-user-section">
                <livewire:user.admin.edit-user-controller />
            </div>
            <div wire:key="delet-user-section">
                <livewire:user.admin.delet-user-controller />
            </div>
        </div>

        <!-- Pagination -->
        @if ($user->hasPages())
            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">{{ $user->firstItem() }}</span>
                    sampai <span class="font-medium">{{ $user->lastItem() }}</span>
                    dari <span class="font-medium">{{ $user->total() }}</span> data
                </div>
                <div>
                    {{ $user->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @endif
    </div>
</div>
