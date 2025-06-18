<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Dashboard Kependudukan</h1>
            <p class="text-blue-100">Data statistik penduduk Kelurahan Kramat</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Filter Data</h3>
            <div class="flex flex-col md:flex-row justify-start gap-6">
                <!-- Dropdown RW -->
                <div class="min-w-48">
                    <label for="rw" class="block text-sm font-medium text-gray-700 mb-2">Filter RW</label>
                    <select wire:model.live="id_RW" id="rw"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white">
                        <option value="">Semua RW</option>
                        @foreach ($rwList as $rw)
                            <option value="{{ $rw->id_RW }}">RW {{ $rw->no_RW }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown RT -->
                <div class="min-w-48">
                    <label for="rt" class="block text-sm font-medium text-gray-700 mb-2">Filter RT</label>
                    <select wire:model.live="id_RT" id="rt"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white"
                        {{ !$id_RW ? 'disabled' : '' }}>
                        <option value="">{{ $id_RW ? 'Semua RT' : 'Pilih RW terlebih dahulu' }}</option>
                        @foreach ($rtList as $rt)
                            <option value="{{ $rt->id_RT }}">RT {{ $rt->no_RT }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Reset Button -->
                <div class="flex items-end">
                    <button wire:click="$set('id_RW', null); $set('id_RT', null)"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors duration-200">
                        Reset Filter
                    </button>
                </div>
            </div>

            <!-- Filter Info -->
            @if ($id_RW || $id_RT)
                <div class="mt-4 p-3 bg-blue-50 rounded-md border border-blue-200">
                    <p class="text-sm text-blue-800">
                        <span class="font-medium">Filter aktif:</span>
                        @if ($id_RW)
                            RW {{ $rwList->where('id_RW', $id_RW)->first()?->no_RW }}
                        @endif
                        @if ($id_RT)
                            @if ($id_RW)
                                ,
                            @endif
                            RT {{ $rtList->where('id_RT', $id_RT)->first()?->no_RT }}
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto p-6">
        <!-- Doughnut Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Chart WNA -->
            <livewire:chart.wna :data="$WNAData" />

            <!-- Chart WNI -->
            <livewire:chart.wni :data="$WNIData" />

            <!-- Chart Total -->
            <livewire:chart.total :data="$totalData" />

        </div>

        <!-- Summary Cards -->
        <livewire:chart.summary :data="[
            'totalWNA' => $totalWNA,
            'totalWNI' => $totalWNI,
            'total' => $totalWarga,
        ]" />

        <!-- bar Cards -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Angka Kelahiran Per Tahun -->
            <livewire:chart.kelahiran :data="$dataKelahiran" />

            <!-- Angka Kematian Per Tahun -->
            <livewire:chart.kematian :data="$dataKematian" />

            <!-- Generasi Penduduk -->
            <livewire:chart.generasi :data="$generasi" />

            <!-- Status Perkawinan -->
            <livewire:chart.perkawinan :data="$perkawinan" />

            <!-- Agama -->
            <livewire:chart.agama :data="$agama" />

            <!-- Pendidikan Penduduk -->
            <livewire:chart.pendidikan :data="$pendidikan" />

        </div>
    </div>
</div>
