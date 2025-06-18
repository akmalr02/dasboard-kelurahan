<div>
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
                        <span class="inline-block w-3 h-3 rounded-full bg-pink-400 mr-2"></span>
                        <span class="font-medium">Perempuan</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
                        <span class="font-medium">Laki-laki</span>
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
                    <div class="bg-pink-50 p-3 rounded-lg">
                        <div class="text-xl font-bold text-pink-600" id="total-female">-</div>
                        <div class="text-xs text-gray-600">Perempuan</div>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <div class="text-xl font-bold text-blue-600" id="total-male">-</div>
                        <div class="text-xs text-gray-600">Laki-laki</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
