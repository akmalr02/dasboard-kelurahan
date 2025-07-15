<x-modal wire:model="isOpen" maxWidth="max-w-md">
    <div class="p-6">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h2>
                <p class="text-sm text-gray-500">Data akan dihapus secara permanen.</p>
            </div>
        </div>

        <!-- Body -->
        <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus surat pengantar ini?</p>

        <!-- Footer -->
        <div class="flex justify-end gap-3">
            <button wire:click="closeModal"
                class="px-4 py-2 text-gray-700 bg-gray-100 rounded hover:bg-gray-200 transition">Batal</button>
            <button wire:click="deletPengantar"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition flex items-center gap-2">
                <x-heroicon-o-trash class="w-5 h-5" />
                Hapus
            </button>
        </div>
    </div>
</x-modal>
