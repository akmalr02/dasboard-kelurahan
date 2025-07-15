<x-modal wire:model="isOpen" maxWidth="max-w-4xl">
    <!-- Header -->
    <div class="flex justify-between items-center p-6 border-b">
        <div class="flex gap-3 items-center">
            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Edit Surat Kelahiran</h2>
                <p class="text-sm text-gray-500">Perbarui data surat kelahiran</p>
            </div>
        </div>
        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Body -->
    <div class="p-6">
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-lg">
                <h3 class="text-red-700 font-semibold mb-2">Terdapat kesalahan:</h3>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit.prevent="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Anak -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Anak</label>
                    <input type="text" wire:model.defer="nama_anak" placeholder="Masukkan nama anak"
                        class="w-full px-4 py-2 border rounded-lg @error('nama_anak') border-red-500 @enderror">
                    @error('nama_anak')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select wire:model.defer="jenis_kelamin"
                        class="w-full px-4 py-2 border rounded-lg @error('jenis_kelamin') border-red-500 @enderror">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" wire:model.defer="tempat_lahir" placeholder="Masukkan tempat lahir"
                        class="w-full px-4 py-2 border rounded-lg @error('tempat_lahir') border-red-500 @enderror">
                    @error('tempat_lahir')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" wire:model.defer="tanggal_lahir"
                        class="w-full px-4 py-2 border rounded-lg @error('tanggal_lahir') border-red-500 @enderror">
                    @error('tanggal_lahir')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hari Lahir -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Hari Lahir</label>
                    <input type="text" wire:model.defer="hari_lahir" placeholder="Contoh: Senin"
                        class="w-full px-4 py-2 border rounded-lg @error('hari_lahir') border-red-500 @enderror">
                    @error('hari_lahir')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Ibu -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-female text-pink-500 mr-2"></i> Ibu <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="id_ibu" wire:key="select-ibu-{{ $suratId }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Ibu --</option>
                        @foreach ($anggotaKeluarga as $warga)
                            <option value="{{ $warga->id_warga }}" {{ $id_ibu == $warga->id_warga ? 'selected' : '' }}>
                                {{ $warga->name }} ({{ $warga->status_keluarga }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_ibu')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ayah -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-male text-blue-500 mr-2"></i> Ayah <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="id_ayah" wire:key="select-ayah-{{ $suratId }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Ayah --</option>
                        @foreach ($anggotaKeluarga as $warga)
                            <option value="{{ $warga->id_warga }}"
                                {{ $id_ayah == $warga->id_warga ? 'selected' : '' }}>
                                {{ $warga->name }} ({{ $warga->status_keluarga }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_ayah')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="flex justify-end items-center gap-3 p-6 border-t bg-gray-50">
        <button wire:click="closeModal"
            class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
            Batal
        </button>
        <button wire:click="update" wire:loading.attr="disabled" wire:target="update"
            class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
            <svg wire:loading.remove wire:target="update" class="w-4 h-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <svg wire:loading wire:target="update" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4" />
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
            </svg>
            <span wire:loading.remove wire:target="update">Simpan</span>
            <span wire:loading wire:target="update">Menyimpan...</span>
        </button>
    </div>
</x-modal>
