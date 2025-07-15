<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Tanda Tangan Digital</h2>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="text-green-700 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="text-red-700 font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Current Signature -->
    <div class="flex items-start space-x-6">
        <div class="flex-shrink-0">
            @if ($user->ttd_digital)
                <div class="bg-white border-2 border-gray-200 rounded-lg p-4 shadow-sm">
                    <img src="{{ asset('storage/' . $user->ttd_digital) }}" alt="Tanda Tangan Digital"
                        class="w-40 h-20 object-contain">
                </div>
            @else
                <div
                    class="w-40 h-20 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-gray-200 border-dashed">
                    <div class="text-center">
                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        <span class="text-xs text-gray-500">Belum ada</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex-grow">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tanda Tangan Digital</h3>
            <p class="text-sm text-gray-600 mb-4">
                @if ($user->ttd_digital)
                    Tanda tangan digital telah diatur. Anda dapat menggantinya dengan tanda tangan baru atau
                    menghapusnya.
                @else
                    Belum ada tanda tangan digital. Upload tanda tangan untuk keperluan dokumen digital.
                @endif
            </p>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800">Tips Tanda Tangan Digital:</h4>
                        <ul class="mt-1 text-sm text-blue-700 list-disc list-inside">
                            <li>Gunakan background putih/transparan</li>
                            <li>Maksimal ukuran file 1MB</li>
                            <li>Format PNG, JPG, atau JPEG</li>
                            <li>Pastikan tanda tangan terlihat jelas</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3">
                <button wire:click="$set('showTtdModal', true)"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                    {{ $user->ttd_digital ? 'Ganti Tanda Tangan' : 'Upload Tanda Tangan' }}
                </button>

                @if ($user->ttd_digital)
                    <button wire:click="hapusTandaTangan"
                        wire:confirm="Apakah Anda yakin ingin menghapus tanda tangan digital?"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Hapus Tanda Tangan
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Upload Tanda Tangan -->
    <x-modal wire:model="showTtdModal" max-width="md">
        <div class="p-6">
            <form wire:submit.prevent="uploadTandaTangan">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Upload Tanda Tangan Digital</h3>
                    <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih File Tanda Tangan
                    </label>
                    <input type="file" wire:model="ttd_digital" accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, atau JPEG (Maksimal 1MB)</p>

                    @error('ttd_digital')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview -->
                @if ($ttd_digital)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview Tanda Tangan</label>
                        <div class="bg-white border border-gray-200 rounded-lg p-4 inline-block">
                            <img src="{{ $ttd_digital->temporaryUrl() }}" alt="Preview Tanda Tangan"
                                class="max-w-40 max-h-20 object-contain">
                        </div>
                    </div>
                @endif

                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="uploadFotoProfil, foto_profil"
                        class="px-4 py-2 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="uploadTandaTangan">Simpan</span>
                        <span wire:loading wire:target="uploadTandaTangan" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Mengunggah...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
