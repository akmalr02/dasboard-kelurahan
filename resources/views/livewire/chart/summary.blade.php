<div>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total WNA</p>
                    <p class="text-2xl font-bold text-blue-600" id="summary-wna">{{ $data['totalWNA'] }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <span class="text-2xl">👥</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-gray-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total WNI</p>
                    <p class="text-2xl font-bold text-gray-600" id="summary-wni">{{ $data['totalWNI'] }}</p>
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
                    <p class="text-2xl font-bold text-purple-600" id="summary-total">{{ $data['total'] }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <span class="text-2xl">📊</span>
                </div>
            </div>
        </div>
    </div>
</div>
