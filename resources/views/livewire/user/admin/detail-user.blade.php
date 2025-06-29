<div>
    <!-- Modal Background -->
    @if ($show)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
            wire:click.self="closeModal">

            <!-- Modal Content -->
            <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full mx-4 p-6 transform transition-all duration-300"
                wire:click.stop>
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Detail User</h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                @if ($user)
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                <p class="text-gray-900">{{ $user->name }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <p class="text-gray-900">{{ $user->email }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $user->role === 'admin'
                                        ? 'bg-red-100 text-red-800'
                                        : ($user->role === 'rw'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>

                            @if ($user->id_rw)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                                    <p class="text-gray-900">{{ $user->id_rw }}</p>
                                </div>
                            @endif

                            @if ($user->id_rt)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                                    <p class="text-gray-900">{{ $user->id_rt }}</p>
                                </div>
                            @endif

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-1">ID User</label>
                                <p class="text-gray-900 font-mono">{{ $user->id_user }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-500">Data user tidak ditemukan</div>
                    </div>
                @endif

                <!-- Modal Footer -->
                <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                    <button wire:click="closeModal"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
