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
                        clip-rule="evenodd" />
                </svg>
                <span class="text-green-700 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Current Signature -->
    <div class="flex items-start space-x-6">
        <div class="flex-shrink-0">
            @if ($user->ttd_digital)
                <img src="{{ secure_asset('storage/' . $user->ttd_digital) }}" alt="Tanda Tangan Digital"
                    class="w-32 h-32 rounded-lg object-contain border-2 border-gray-200 shadow-sm bg-white">
            @else
                <div class="w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-gray-200">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 16l4-4a3 3 0 014 0l4 4m0 0h5m-5 0a3 3 0 01-4 0l-4-4" />
                    </svg>
                </div>
            @endif
        </div>

        <div class="flex-grow">
            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $user->name }}</h3>
            <p class="text-sm text-gray-600 mb-4">
                @if ($user->ttd_digital)
                    Tanda tangan digital telah diunggah. Anda dapat menggantinya dengan file baru.
                @else
                    Belum ada tanda tangan digital. Silakan upload terlebih dahulu.
                @endif
            </p>

            <div class="flex space-x-3">
                <button wire:click="$set('showTtdModal', true)"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ $user->ttd_digital ? 'Ganti Tanda Tangan' : 'Upload Tanda Tangan' }}
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Upload TTD -->
    <x-modal wire:model="showTtdModal" max-width="md">
        <div class="p-6">
            <form wire:submit.prevent="uploadTandaTangan">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Upload Tanda Tangan Digital</h3>
                    <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                @if ($errors->count() == 1)
                                    <p class="text-sm text-red-600 font-medium">{{ $errors->first() }}</p>
                                @else
                                    <ul class="text-sm text-red-600 list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih File Tanda Tangan
                    </label>

                    <div wire:loading wire:target="ttd_digital" class="mb-2 text-blue-600 text-sm flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.4 0 0 5.4 0 12h4zm2 5.3A8 8 0 014 12H0c0 3 1.1 5.8 3 7.9l3-2.6z" />
                            </path>
                        </svg>
                        Memproses file...
                    </div>

                    <input type="file" wire:model="ttd_digital" accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                    <p class="mt-1 text-xs text-gray-500">Format PNG, JPG, JPEG (maksimal 1MB)</p>

                    @error('ttd_digital')
                        <div class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if ($ttd_digital)
                    <div class="mb-4" wire:loading.remove wire:target="ttd_digital">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                        <div class="relative">
                            <img src="{{ $ttd_digital->temporaryUrl() }}" alt="Preview"
                                class="w-24 h-24 rounded-lg object-contain border border-gray-200 shadow-sm bg-white">
                            <div class="absolute -top-2 -right-2">
                                <button type="button" wire:click="$set('ttd_digital', null)"
                                    class="bg-red-100 hover:bg-red-200 text-red-600 rounded-full p-1 shadow-sm">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="uploadTandaTangan, ttd_digital"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                        @disabled(!$ttd_digital)>
                        <span wire:loading.remove wire:target="uploadTandaTangan">
                            {{ $ttd_digital ? 'Simpan' : 'Pilih File' }}
                        </span>
                        <span wire:loading wire:target="uploadTandaTangan" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="m4 12a8 8 0 018-8V0C5.4 0 0 5.4 0 12h4zm2 5.3A8 8 0 014 12H0c0 3 1.1 5.8 3 7.9l3-2.6z" />
                            </svg>
                            Mengunggah...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
