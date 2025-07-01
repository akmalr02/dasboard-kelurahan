<div class="space-y-10">

    <!-- Foto Profil -->
    <div>
        <h2 class="text-lg font-semibold">Foto Profil</h2>
        @if ($user->foto_profil)
            <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-24 h-24 rounded-lg object-cover">
            <button wire:click="hapusFotoProfil" class="mt-2 px-3 py-1 bg-red-500 text-white rounded">Hapus</button>
        @endif
        <button wire:click="$set('showFotoModal', true)" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Upload
            Baru</button>
    </div>

    <!-- Modal Foto -->
    <x-modal wire:model="showFotoModal">
        <form wire:submit.prevent="uploadFotoProfil">
            <h3 class="text-lg font-bold mb-2">Upload Foto</h3>
            <input type="file" wire:model="foto_profil" class="mb-2">
            @error('foto_profil')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div class="flex justify-end gap-2">
                <button type="button" wire:click="$set('showFotoModal', false)"
                    class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </x-modal>

    <!-- Tanda Tangan -->
    <div>
        <h2 class="text-lg font-semibold">Tanda Tangan Digital</h2>
        @if ($user->ttd_digital)
            <img src="{{ asset('storage/' . $user->ttd_digital) }}" class="w-32 h-16 object-contain rounded">
            <button wire:click="hapusTandaTangan" class="mt-2 px-3 py-1 bg-red-500 text-white rounded">Hapus</button>
        @endif
        <button wire:click="$set('showTtdModal', true)" class="mt-2 px-4 py-2 bg-purple-600 text-white rounded">Upload
            Baru</button>
    </div>

    <!-- Modal TTD -->
    <x-modal wire:model="showTtdModal">
        <form wire:submit.prevent="uploadTandaTangan">
            <h3 class="text-lg font-bold mb-2">Upload Tanda Tangan</h3>
            <input type="file" wire:model="ttd_digital" class="mb-2">
            @error('ttd_digital')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div class="flex justify-end gap-2">
                <button type="button" wire:click="$set('showTtdModal', false)"
                    class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </x-modal>

    <!-- Ganti Password -->
    <div>
        <h2 class="text-lg font-semibold">Ganti Password</h2>
        <button wire:click="$set('showPasswordModal', true)" class="mt-2 px-4 py-2 bg-gray-700 text-white rounded">Ganti
            Password</button>
    </div>

    <!-- Modal Password -->
    <x-modal wire:model="showPasswordModal">
        <form wire:submit.prevent="gantiPassword">
            <h3 class="text-lg font-bold mb-2">Ganti Password</h3>
            <input type="password" wire:model="new_password" placeholder="Password Baru" class="mb-2 w-full">
            <input type="password" wire:model="new_password_confirmation" placeholder="Konfirmasi Password"
                class="mb-2 w-full">
            @error('new_password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <div class="flex justify-end gap-2">
                <button type="button" wire:click="$set('showPasswordModal', false)"
                    class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </x-modal>

</div>
