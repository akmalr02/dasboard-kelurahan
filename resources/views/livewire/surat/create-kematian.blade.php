<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white py-6 shadow-lg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center space-x-3">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold">Buat Surat Kematian</h1>
                    <p class="text-red-100 text-sm mt-1">Lengkapi formulir berikut untuk membuat surat kematian</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Tombol Kembali -->
        <div class="mb-8">
            <a href="{{ route('kematian') }}" wire:navigate
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Success Message -->
        @if (session()->has('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
                    <div>
                        <h4 class="font-semibold text-green-800 mb-1">Berhasil!</h4>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-form mr-2 text-red-600"></i>
                    Data Kematian
                </h2>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="create" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                    <!-- Data Almarhum Section -->
                    <div class="xl:col-span-3">
                        <div class="border-l-4 border-red-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Informasi Almarhum/Almarhumah</h3>
                        </div>
                    </div>

                    <!-- Nama Warga -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user text-red-500 mr-2"></i>
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model.defer="nama_warga"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                            placeholder="Masukkan nama lengkap almarhum/almarhumah">
                        @error('nama_warga')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model.defer="tempat_lahir"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                            placeholder="Contoh: Jakarta">
                        @error('tempat_lahir')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-calendar-alt text-red-500 mr-2"></i>
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model.defer="tanggal_lahir"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                        @error('tanggal_lahir')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-venus-mars text-red-500 mr-2"></i>
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.defer="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Agama -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-pray text-red-500 mr-2"></i>
                            Agama <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.defer="agama"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        @error('agama')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-home text-red-500 mr-2"></i>
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model.defer="alamat"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                            placeholder="Alamat lengkap almarhum/almarhumah">
                        @error('alamat')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Data Kematian Section -->
                    <div class="xl:col-span-3 mt-10">
                        <div class="border-l-4 border-purple-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Informasi Kematian</h3>
                        </div>
                    </div>

                    <!-- Hari Meninggal -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-clock text-purple-500 mr-2"></i>
                            Hari Meninggal <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.defer="hari_meninggal"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        @error('hari_meninggal')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Meninggal -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-calendar-times text-purple-500 mr-2"></i>
                            Tanggal Meninggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model.defer="tanggal_meninggal"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                        @error('tanggal_meninggal')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Jam Meninggal -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-clock text-purple-500 mr-2"></i>
                            Jam Meninggal <span class="text-red-500">*</span>
                        </label>
                        <input type="time" wire:model.defer="jam_meninggal"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                        @error('jam_meninggal')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Penyebab -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-stethoscope text-purple-500 mr-2"></i>
                            Penyebab Kematian
                        </label>
                        <input type="text" wire:model.defer="penyebab"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                            placeholder="Penyebab kematian (opsional)">
                        @error('penyebab')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tempat Pemakaman -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-cross text-purple-500 mr-2"></i>
                            Tempat Pemakaman
                        </label>
                        <input type="text" wire:model.defer="tempat_pemakaman"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                            placeholder="Lokasi pemakaman (opsional)">
                        @error('tempat_pemakaman')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-10 pt-8 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 sm:justify-end">
                        <button type="submit"
                            class="px-8 py-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 shadow-md hover:shadow-lg font-medium text-lg">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Surat Kematian
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-red-500 mt-0.5 mr-3"></i>
                <div>
                    <h4 class="font-semibold text-red-800 mb-1">Informasi Penting</h4>
                    <p class="text-red-700 text-sm">
                        Surat kematian adalah dokumen resmi yang diperlukan untuk berbagai keperluan administratif.
                        Pastikan semua data yang dimasukkan sudah benar dan sesuai dengan dokumen resmi yang ada.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
