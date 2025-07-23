<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white py-6 shadow-lg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-baby text-2xl"></i>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold">Buat Surat Kelahiran</h1>
                    <p class="text-blue-100 text-sm mt-1">Lengkapi formulir berikut untuk membuat surat kelahiran</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Tombol Kembali -->
        <div class="mb-8">
            <a href="{{ route('kelahiran') }}" wire:navigate
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
                    <i class="fas fa-form mr-2 text-blue-600"></i>
                    Data Kelahiran Anak
                </h2>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="store" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                    <!-- Data Anak Section -->
                    <div class="xl:col-span-3">
                        <div class="border-l-4 border-blue-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Informasi Anak</h3>
                        </div>
                    </div>

                    <!-- Nama Anak -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Nama Lengkap Anak <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="nama_anak"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Masukkan nama lengkap anak">
                        @error('nama_anak')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Nama Ke- <span class="text-red-500">*</span>
                        </label>
                        <input type="text" inputmode="numeric" wire:model="anak_ke"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Anak Ke-">
                        @error('anak_ke')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-venus-mars text-blue-500 mr-2"></i>
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L"> Laki-laki</option>
                            <option value="P"> Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="tempat_lahir"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
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
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="tanggal_lahir"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        @error('tanggal_lahir')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Hari Lahir -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            Hari Lahir <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="hari_lahir"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                        @error('hari_lahir')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Data Orang Tua Section -->
                    <div class="xl:col-span-3 mt-10">
                        <div class="border-l-4 border-green-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Informasi Orang Tua</h3>
                        </div>
                    </div>

                    <!-- Ibu -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-female text-pink-500 mr-2"></i>
                            Ibu <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="id_ibu"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Ibu --</option>
                            @foreach ($this->anggotaKeluarga as $warga)
                                <option value="{{ $warga->id_warga }}">
                                    {{ $warga->name }} ({{ $warga->status_keluarga }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_ibu')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Ayah -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-male text-blue-500 mr-2"></i>
                            Ayah <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="id_ayah"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Ayah --</option>
                            @foreach ($this->anggotaKeluarga as $warga)
                                <option value="{{ $warga->id_warga }}">
                                    {{ $warga->name }} ({{ $warga->status_keluarga }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_ayah')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-10 pt-8 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4 sm:justify-end">
                            <button type="submit"
                                class="px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg font-medium text-lg">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Surat Kelahiran
                            </button>
                        </div>
                    </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                <div>
                    <h4 class="font-semibold text-blue-800 mb-1">Informasi Penting</h4>
                    <p class="text-blue-700 text-sm">
                        Pastikan semua data yang dimasukkan sudah benar dan sesuai dengan dokumen resmi.
                        Surat kelahiran yang telah dibuat tidak dapat diubah tanpa prosedur khusus.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
