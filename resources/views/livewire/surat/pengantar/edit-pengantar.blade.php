<x-modal wire:model="isOpen" maxWidth="max-w-4xl">
    <!-- Header -->
    <div class="flex justify-between items-center p-6 border-b">
        <div class="flex gap-3 items-center">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Edit Surat Pengantar</h2>
                <p class="text-sm text-gray-500">Perbarui data surat pengantar</p>
            </div>
        </div>
        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Modal Body -->
    <div class="p-6 max-h-96 overflow-y-auto">
        <!-- Session Flash Messages -->
        @if (session()->has('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                </div>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit.prevent="update">
            <!-- Personal Information Section -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Data Pribadi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model="nama"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('nama') @enderror"
                            placeholder="Masukkan nama lengkap">
                        @error('nama')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIK <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model="NIK" maxlength="16"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('NIK') @enderror"
                            placeholder="Masukkan NIK (16 digit)">
                        @error('NIK')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NKK <span
                                class="text-red-500">*</span></label>
                        <input type="text" wire:model="NKK" maxlength="16"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('NKK') @enderror"
                            placeholder="Masukkan NKK (16 digit)">
                        @error('NKK')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span
                                class="text-red-500">*</span></label>
                        <select wire:model="jenis_kelamin"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('jenis_kelamin') @enderror">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                        <input type="text" wire:model="tempat_lahir"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('tempat_lahir') @enderror"
                            placeholder="Masukkan tempat lahir">
                        @error('tempat_lahir')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" wire:model="tanggal_lahir"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('tanggal_lahir') @enderror">
                        @error('tanggal_lahir')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Personal Status Section -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Status Pribadi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan <span
                                class="text-red-500">*</span></label>
                        <select wire:model="status_perkawinan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('status_perkawinan') @enderror">
                            <option value="">Pilih status perkawinan</option>
                            <option value="Kawin">Kawin</option>
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                        @error('status_perkawinan')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kewarganegaraan <span
                                class="text-red-500">*</span></label>
                        <select wire:model="kewarganegaraan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('kewarganegaraan') @enderror">
                            <option value="">Pilih kewarganegaraan</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                        @error('kewarganegaraan')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Agama <span
                                class="text-red-500">*</span></label>
                        <select wire:model="agama"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('agama') @enderror">
                            <option value="">Pilih agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('agama')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                        <input type="text" wire:model="pekerjaan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('pekerjaan') @enderror"
                            placeholder="Masukkan pekerjaan">
                        @error('pekerjaan')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Informasi Kontak
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea wire:model="alamat" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('alamat') @enderror"
                            placeholder="Masukkan alamat lengkap"></textarea>
                        @error('alamat')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" wire:model="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('email') @enderror"
                            placeholder="contoh@email.com">
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keperluan <span
                                class="text-red-500">*</span></label>
                        <textarea wire:model="keperluan" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('keperluan') @enderror"
                            placeholder="Jelaskan keperluan surat pengantar..."></textarea>
                        @error('keperluan')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- File Upload Section -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 00-5.656-5.656l-6.586 6.586a6 6 0 108.486 8.486" />
                    </svg>
                    Dokumen Pendukung
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto KTP Section -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto KTP</label>

                        @if ($foto_ktp_lama)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Foto KTP saat ini:</p>
                                <img src="{{ secure_asset('storage/' . $foto_ktp_lama) }}" alt="Foto KTP"
                                    class="w-32 h-auto rounded border border-gray-300 mb-2">
                                <div class="flex gap-2">
                                    <a href="{{ secure_asset('storage/' . $foto_ktp_lama) }}" target="_blank"
                                        class="px-3 py-1 text-xs text-white bg-green-600 rounded hover:bg-green-700">
                                        Lihat
                                    </a>
                                    <a href="{{ secure_asset('storage/' . $foto_ktp_lama) }}" download
                                        class="px-3 py-1 text-xs text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @endif

                        <input type="file" wire:model="foto_ktp" accept="image/jpeg,image/png,image/jpg"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('foto_ktp') @enderror">
                        <p class="text-xs text-gray-500 mt-1">JPG, JPEG, PNG. Maksimal 1MB</p>

                        @error('foto_ktp')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror

                        @if ($foto_ktp)
                            <div class="bg-blue-50 p-3 rounded-lg mt-3">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview Foto KTP Baru:</p>
                                <img src="{{ $foto_ktp->temporaryUrl() }}" alt="Preview Foto KTP"
                                    class="w-32 h-auto rounded border border-gray-400">
                            </div>
                        @endif

                        <div wire:loading wire:target="foto_ktp" class="text-sm text-blue-600 mt-2">
                            Mengupload foto...
                        </div>
                    </div>

                    <!-- File PDF Section -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Surat (PDF)</label>

                        @if ($file_pdf_lama)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">File PDF saat ini:</p>
                                <div class="flex gap-2 mb-2">
                                    <a href="{{ secure_asset('storage/' . $file_pdf_lama) }}" target="_blank"
                                        class="px-3 py-1 text-xs text-white bg-green-600 rounded hover:bg-green-700">
                                        Lihat PDF
                                    </a>
                                    <a href="{{ secure_asset('storage/' . $file_pdf_lama) }}" download
                                        class="px-3 py-1 text-xs text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                        Download
                                    </a>
                                </div>
                            </div>
                        @endif

                        <input type="file" wire:model="file_pdf" accept="application/pdf"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('file_pdf') @enderror">
                        <p class="text-xs text-gray-500 mt-1">PDF. Maksimal 2MB</p>

                        @error('file_pdf')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror

                        @if ($file_pdf)
                            <div class="bg-blue-50 p-3 rounded-lg mt-3">
                                <p class="text-sm font-medium text-gray-700 mb-2">File PDF Baru:</p>
                                <p class="text-sm text-gray-600">{{ $file_pdf->getClientOriginalName() }}</p>
                                <p class="text-xs text-gray-500">Ukuran:
                                    {{ number_format($file_pdf->getSize() / 1024, 2) }} KB</p>
                            </div>
                        @endif

                        <div wire:loading wire:target="file_pdf" class="text-sm text-blue-600 mt-2">
                            Mengupload PDF...
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="flex justify-end items-center gap-3 p-6 border-t bg-gray-50">
        <button wire:click="closeModal" type="button"
            class="px-5 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors duration-200">
            Batal
        </button>
        <button wire:click="update" wire:loading.attr="disabled" wire:target="update"
            class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
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
            <span wire:loading.remove wire:target="update">Perbarui Data</span>
            <span wire:loading wire:target="update">Memperbarui...</span>
        </button>
    </div>
</x-modal>
