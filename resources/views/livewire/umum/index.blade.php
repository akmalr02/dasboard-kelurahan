<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Dashboard Kependudukan</h1>
            <p class="text-blue-100">Data statistik penduduk Kelurahan Kramat</p>
        </div>
    </div>

    {{-- tambahkan filter  berdasarkan RT RW --}}

    <div class="max-w-7xl mx-auto p-6">
        <!-- Doughnut Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Chart WNA -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-500 to-gray-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        👥 Jumlah Penduduk WNA
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Legend -->
                    <div class="flex justify-center mb-4">
                        <div class="flex space-x-4 text-sm">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                <span class="font-medium">Laki-laki</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-pink-400 mr-2"></span>
                                <span class="font-medium">Perempuan</span>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Container -->
                    <div class="relative h-64 flex items-center justify-center">
                        <canvas id="chartWargaWNA" class="max-h-full max-w-full"></canvas>
                    </div>
                    <!-- Stats Summary -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <div class="text-xl font-bold text-blue-600" id="wna-male">-</div>
                                <div class="text-xs text-gray-600">Laki-laki</div>
                            </div>
                            <div class="bg-pink-50 p-3 rounded-lg">
                                <div class="text-xl font-bold text-pink-600" id="wna-female">-</div>
                                <div class="text-xs text-gray-600">Perempuan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart WNI -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        👥 Jumlah Penduduk WNI
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Legend -->
                    <div class="flex justify-center mb-4">
                        <div class="flex space-x-4 text-sm">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                <span class="font-medium">Laki-laki</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-pink-400 mr-2"></span>
                                <span class="font-medium">Perempuan</span>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Container -->
                    <div class="relative h-64 flex items-center justify-center">
                        <canvas id="chartWargaWNI" class="max-h-full max-w-full"></canvas>
                    </div>
                    <!-- Stats Summary -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <div class="text-xl font-bold text-blue-600" id="wni-male">-</div>
                                <div class="text-xs text-gray-600">Laki-laki</div>
                            </div>
                            <div class="bg-pink-50 p-3 rounded-lg">
                                <div class="text-xl font-bold text-pink-600" id="wni-female">-</div>
                                <div class="text-xs text-gray-600">Perempuan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Total -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        📊 Jumlah Penduduk Total
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Legend -->
                    <div class="flex justify-center mb-4">
                        <div class="flex space-x-4 text-sm">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                <span class="font-medium">Laki-laki</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-pink-400 mr-2"></span>
                                <span class="font-medium">Perempuan</span>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Container -->
                    <div class="relative h-64 flex items-center justify-center">
                        <canvas id="chartTotalWarga" class="max-h-full max-w-full"></canvas>
                    </div>
                    <!-- Stats Summary -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <div class="text-xl font-bold text-blue-600" id="total-male">-</div>
                                <div class="text-xs text-gray-600">Laki-laki</div>
                            </div>
                            <div class="bg-pink-50 p-3 rounded-lg">
                                <div class="text-xl font-bold text-pink-600" id="total-female">-</div>
                                <div class="text-xs text-gray-600">Perempuan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total WNI</p>
                        <p class="text-2xl font-bold text-blue-600" id="summary-wni">-</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <span class="text-2xl">👥</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-gray-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total WNA</p>
                        <p class="text-2xl font-bold text-gray-600" id="summary-wna">-</p>
                    </div>
                    <div class="bg-gray-100 p-3 rounded-full">
                        <span class="text-2xl">👥</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Penduduk</p>
                        <p class="text-2xl font-bold text-purple-600" id="summary-total">-</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <span class="text-2xl">📊</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- bar Cards -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Angka Kelahiran Per Tahun -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        📈 Angka Kelahiran Per Tahun
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Legend -->
                    <div class="flex justify-center mb-4">
                        <div class="flex space-x-4 text-sm">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-cyan-400 mr-2"></span>
                                <span class="font-medium">Laki-laki</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-pink-400 mr-2"></span>
                                <span class="font-medium">Perempuan</span>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Container -->
                    <div class="relative h-80">
                        <canvas id="chartKelahiran"></canvas>
                    </div>
                </div>
            </div>

            <!-- Angka Kematian Per Tahun -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        📈 Angka Kematian Per Tahun
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Legend -->
                    <div class="flex justify-center mb-4">
                        <div class="flex space-x-4 text-sm">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-cyan-400 mr-2"></span>
                                <span class="font-medium">Laki-laki</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-pink-400 mr-2"></span>
                                <span class="font-medium">Perempuan</span>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Container -->
                    <div class="relative h-80">
                        <canvas id="chartKematian"></canvas>
                    </div>
                </div>
            </div>

            <!-- Generasi Penduduk -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        👨‍👩‍👧‍👦 Generasi Penduduk
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Chart Container -->
                    <div class="relative h-80">
                        <canvas id="chartGenerasi"></canvas>
                    </div>
                </div>
            </div>

            <!-- Status Perkawinan -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        💑 Status Perkawinan
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Legend -->
                    <div class="flex justify-center mb-4">
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-cyan-400 mr-2"></span>
                                <span class="font-medium">Belum Kawin</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-blue-600 mr-2"></span>
                                <span class="font-medium">Kawin</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-pink-500 mr-2"></span>
                                <span class="font-medium">Cerai Mati</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-indigo-600 mr-2"></span>
                                <span class="font-medium">Cerai Hidup</span>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Container -->
                    <div class="relative h-80">
                        <canvas id="chartPerkawinan"></canvas>
                    </div>
                </div>
            </div>

            <!-- Agama -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">☪️ Agama</h2>
                </div>

                <!-- Body -->
                <div class="p-6">
                    <!-- Legend -->
                    <div class="flex justify-center mb-4">
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-cyan-400 mr-2"></span>
                                <span class="font-medium">Islam</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                                <span class="font-medium">Kristen</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-indigo-500 mr-2"></span>
                                <span class="font-medium">Katolik</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-purple-500 mr-2"></span>
                                <span class="font-medium">Hindu</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-pink-500 mr-2"></span>
                                <span class="font-medium">Buddha</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-rose-500 mr-2"></span>
                                <span class="font-medium">Konghucu</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full bg-red-500 mr-2"></span>
                                <span class="font-medium">Lainnya</span>
                            </div>
                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="relative h-80">
                        <canvas id="chartAgama"></canvas>
                    </div>
                </div>
            </div>

            <!-- Pendidikan Penduduk -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 py-4 px-6">
                    <h2 class="text-white font-bold text-lg text-center">
                        🏫 Pendidikan
                    </h2>
                </div>
                <div class="p-6">
                    <!-- Chart Container -->
                    <div class="relative h-96">
                        <canvas id="chartPendidikan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
