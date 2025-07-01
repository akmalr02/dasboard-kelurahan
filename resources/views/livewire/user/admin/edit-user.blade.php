<div x-data="{ open: @entangle('show') }">
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
        <div @click.outside="open = false; $wire.closeModal()" class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit User</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" wire:model.defer="name"
                        class="w-full border-gray-300 rounded-md shadow-sm mt-1" />
                    @error('name')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model.defer="email"
                        class="w-full border-gray-300 rounded-md shadow-sm mt-1" />
                    @error('email')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select wire:model.defer="role" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="pengelola_rw">Pengelola RW</option>
                        <option value="pengelola_rt">Pengelola RT</option>
                        <option value="warga">Warga</option>
                    </select>
                    @error('role')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button @click="open = false; $wire.closeModal()" class="px-4 py-2 bg-gray-300 rounded-md">
                    Batal
                </button>
                <button wire:click="updateUser" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
