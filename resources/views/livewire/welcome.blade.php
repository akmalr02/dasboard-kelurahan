<div class="min-h-screen bg-gray-50">
    <div class="flex flex-col lg:flex-row gap-6 p-6">
        <!-- Konten Utama -->
        <div class="w-full lg:w-2/3 flex flex-col gap-6">
            <!-- Welcome Banner -->
            <div
                class="bg-gradient-to-r from-blue-100 via-blue-50 to-white border-l-4 border-blue-400 text-blue-800 p-6 rounded-xl shadow-md">
                <h1 class="text-3xl font-bold mb-2">👋 Selamat datang di Website Kelurahan Kramat</h1>
                <p class="text-lg">Temukan informasi wilayah, lokasi, dan layanan kelurahan di sini.</p>
            </div>

            <!-- Accordion Container -->
            <div
                class="bg-gradient-to-r from-blue-100 via-blue-50 to-white border-l-4 border-blue-400 rounded-2xl shadow-xl p-6 space-y-4">
                <!-- Lokasi Kelurahan -->
                <div x-data="{ open: false }" class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full focus:outline-none hover:bg-gray-50 p-2 rounded-lg transition-colors">
                        <span class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            📍 Lokasi Kelurahan
                        </span>
                        <svg :class="{ 'rotate-180': open }"
                            class="w-6 h-6 text-gray-500 transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition.duration.300ms
                        class="mt-4 overflow-hidden rounded-lg border border-gray-200 shadow-inner">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.6475859311836!2d106.84814413580742!3d-6.18554091500386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f44f52110c4f%3A0xa831eaf435b143fe!2sKantor%20Kelurahan%20Kramat%20Jakarta%20Pusat!5e0!3m2!1sid!2sid!4v1747817980009!5m2!1sid!2sid"
                            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Lokasi Kantor Kelurahan Kramat">
                        </iframe>
                    </div>
                </div>

                <!-- Batas Wilayah -->
                <div x-data="{ open: false }" class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full focus:outline-none hover:bg-gray-50 p-2 rounded-lg transition-colors">
                        <span class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            🗺️ Batas Wilayah
                        </span>
                        <svg :class="{ 'rotate-180': open }"
                            class="w-6 h-6 text-gray-500 transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition.duration.300ms
                        class="mt-4 text-base space-y-3 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <p class="flex items-start gap-2">
                                <span class="text-blue-500 font-semibold">Utara:</span>
                                <span>Jl. Kramat Bunder (Kelurahan Senen)</span>
                            </p>
                            <p class="flex items-start gap-2">
                                <span class="text-green-500 font-semibold">Selatan:</span>
                                <span>Jl. Kramat Lontar (Kelurahan Paseban)</span>
                            </p>
                            <p class="flex items-start gap-2">
                                <span class="text-orange-500 font-semibold">Timur:</span>
                                <span>Rel Kereta Api (Kelurahan Tanah Tinggi)</span>
                            </p>
                            <p class="flex items-start gap-2">
                                <span class="text-purple-500 font-semibold">Barat:</span>
                                <span>Jl. Kramat Raya (Kelurahan Kwitang)</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Demografi -->
                <div x-data="{ open: false }" class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full focus:outline-none hover:bg-gray-50 p-2 rounded-lg transition-colors">
                        <span class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            📊 Demografi
                        </span>
                        <svg :class="{ 'rotate-180': open }"
                            class="w-6 h-6 text-gray-500 transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition.duration.300ms class="mt-4 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div class="bg-blue-100 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600">70.87</div>
                                <div class="text-sm text-gray-600">Luas Wilayah (ha)</div>
                            </div>
                            <div class="bg-green-100 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-green-600">8</div>
                                <div class="text-sm text-gray-600">Jumlah RW</div>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-purple-600">96</div>
                                <div class="text-sm text-gray-600">Jumlah RT</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prestasi & Inovasi -->
                <div x-data="{ open: false }" class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full focus:outline-none hover:bg-gray-50 p-2 rounded-lg transition-colors">
                        <span class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            🏆 Prestasi & Inovasi
                        </span>
                        <svg :class="{ 'rotate-180': open }"
                            class="w-6 h-6 text-gray-500 transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition.duration.300ms class="mt-4 bg-gray-50 p-4 rounded-lg">
                        <div class="space-y-3">
                            <div class="flex items-start gap-3 p-3 bg-white rounded-lg border-l-4 border-blue-400">
                                <span class="text-blue-500">📋</span>
                                <span>Layanan konsultasi administrasi pemerintahan umum</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-white rounded-lg border-l-4 border-green-400">
                                <span class="text-green-500">👥</span>
                                <span>Layanan surat keterangan penunjukan orang yang sama</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-white rounded-lg border-l-4 border-purple-400">
                                <span class="text-purple-500">🏠</span>
                                <span>Layanan surat keterangan penunjukan alamat yang sama</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-white rounded-lg border-l-4 border-orange-400">
                                <span class="text-orange-500">💰</span>
                                <span>Layanan pemecahan surat pemberitahuan pajak terhutang PBB</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-white rounded-lg border-l-4 border-red-400">
                                <span class="text-red-500">📝</span>
                                <span>Layanan surat keterangan pendaftaran objek pajak baru</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-white rounded-lg border-l-4 border-pink-400">
                                <span class="text-pink-500">💒</span>
                                <span>Layanan perkawinan di bawah umur (di bawah usia 19 tahun)</span>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-white rounded-lg border-l-4 border-indigo-400">
                                <span class="text-indigo-500">💑</span>
                                <span>Layanan perkawinan pertama (umum)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar - Jam Operasional -->
        <div class="w-full lg:w-1/3">
            <div
                class="bg-gradient-to-r from-blue-100 via-blue-50 to-white border-l-4 border-blue-400 rounded-xl shadow-md p-6 sticky top-6">
                <div class="text-center space-y-6">
                    <!-- Jam Operasional -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-center gap-3">
                            <x-tni-clock-o class="w-8 h-8 text-blue-600" />
                            <h2 class="text-2xl font-bold text-gray-800">Jam Operasional</h2>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="text-xl font-semibold text-gray-700">
                                Senin - Jumat
                            </div>
                            <div class="text-lg text-blue-600 font-medium">
                                08:00 - 16:00 WIB
                            </div>
                        </div>
                    </div>

                    <!-- Jam Istirahat -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-center gap-3">
                            <x-tni-clock-o class="w-8 h-8 text-orange-600" />
                            <h2 class="text-2xl font-bold text-gray-800">Jam Istirahat</h2>
                        </div>
                        <div class="space-y-3">
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="text-lg font-semibold text-gray-700">
                                    Senin - Kamis
                                </div>
                                <div class="text-md text-orange-600 font-medium">
                                    12:00 - 13:00 WIB
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="text-lg font-semibold text-gray-700">
                                    Jumat
                                </div>
                                <div class="text-md text-orange-600 font-medium">
                                    11:30 - 13:00 WIB
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Kontak</h3>
                        <div class="space-y-2 text-sm">
                            <p class="flex items-center gap-2">
                                <span class="text-blue-500">📧</span>
                                <span>kelurahan.kramat@jakarta.go.id</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <span class="text-green-500">📞</span>
                                <span>(021) 123-4567</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <span class="text-red-500">📍</span>
                                <span>Jl. Kramat Raya, Jakarta Pusat</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
