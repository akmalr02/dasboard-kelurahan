<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white py-8 shadow-xl">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center space-x-4">
                <div>
                    <h1 class="text-3xl font-bold mb-1">Buat Surat Pengantar</h1>
                    <p class="text-blue-100 text-sm">Lengkapi formulir berikut untuk membuat surat pengantar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Tombol Kembali -->
        <div class="mb-8">
            <a href="{{ route('pengantar') }}" wire:navigate
                class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Success Message -->
        @if (session()->has('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-400 rounded-lg p-6 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-green-800 text-lg mb-1">Berhasil!</h4>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-user-edit mr-3 text-blue-600"></i>
                    Data Pemohon
                </h2>
                <p class="text-gray-600 text-sm mt-1">Silakan lengkapi data diri Anda dengan benar</p>
            </div>

            <form wire:submit.prevent="create" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                    <!-- Data Identitas Section -->
                    <div class="xl:col-span-3">
                        <div class="border-l-4 border-blue-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Data Identitas</h3>
                        </div>
                    </div>

                    <!-- Nama -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="nama"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Masukkan nama lengkap">
                        @error('nama')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-id-badge text-blue-500 mr-2"></i>
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="NIK"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Nomor Induk Kependudukan">
                        <small class="text-gray-500 text-xs">Diambil otomatis dari akun Anda, bisa diubah jika
                            perlu</small>
                        @error('NIK')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- NKK -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-users text-blue-500 mr-2"></i>
                            NKK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="NKK"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Nomor Kartu Keluarga">
                        <small class="text-gray-500 text-xs">Diambil otomatis dari akun Anda, bisa diubah jika
                            perlu</small>
                        @error('NKK')
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

                    <!-- Tempat Lahir -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="tempat_lahir"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Kota/Kabupaten tempat lahir">
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

                    <!-- Data Personal Section -->
                    <div class="xl:col-span-3 mt-10">
                        <div class="border-l-4 border-green-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Data Personal</h3>
                        </div>
                    </div>

                    <!-- Status Perkawinan -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-heart text-green-500 mr-2"></i>
                            Status Perkawinan <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="status_perkawinan"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Status Perkawinan --</option>
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Kawin">Kawin</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                        @error('status_perkawinan')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Kewarganegaraan -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-flag text-green-500 mr-2"></i>
                            Kewarganegaraan <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="kewarganegaraan"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Kewarganegaraan --</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                        @error('kewarganegaraan')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Agama -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-pray text-green-500 mr-2"></i>
                            Agama <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="agama"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
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

                    <!-- Pekerjaan -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-briefcase text-green-500 mr-2"></i>
                            Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="pekerjaan"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                            placeholder="Profesi/pekerjaan saat ini">
                        @error('pekerjaan')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-home text-green-500 mr-2"></i>
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="alamat"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                            placeholder="Alamat lengkap tempat tinggal">
                        @error('alamat')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Keperluan Section -->
                    <div class="xl:col-span-3 mt-10">
                        <div class="border-l-4 border-purple-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Keperluan Surat</h3>
                        </div>
                    </div>

                    <!-- Keperluan -->
                    <div class="xl:col-span-3 space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-edit text-purple-500 mr-2"></i>
                            Jelaskan Keperluan <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model="keperluan" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none"
                            placeholder="Jelaskan dengan detail keperluan pembuatan surat pengantar ini..."></textarea>
                        <small class="text-gray-500 text-xs">Minimal 10 karakter, maksimal 500 karakter</small>
                        @error('keperluan')
                            <div class="flex items-center mt-1 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Kontak Section -->
                    <div class="xl:col-span-3 mt-10">
                        <div class="border-l-4 border-orange-500 pl-4 mb-8">
                            <h3 class="text-lg font-semibold text-gray-700">Informasi Kontak</h3>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-at text-orange-500 mr-2"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" wire:model="email"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                            placeholder="alamat@email.com">
                        <small class="text-gray-500 text-xs">Email untuk mengirimkan notifikasi status surat</small>
                        @error('email')
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
                            class="px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg font-medium text-lg">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Ajukan Surat Pengantar
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
                        Surat pengantar adalah dokumen resmi yang diperlukan untuk berbagai keperluan administratif.
                        Pastikan semua data yang dimasukkan sudah benar dan sesuai dengan dokumen resmi yang ada.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
