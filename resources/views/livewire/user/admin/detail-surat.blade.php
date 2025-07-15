@if ($showDetailModal && $selectedSurat)
    <x-modal wire:model="showDetailModal">
        <div class="space-y-6 max-h-[80vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-4">
                <h2 class="text-xl font-bold text-gray-800">Detail Surat {{ ucfirst($jenis) }}</h2>
                <button wire:click="closeDetailModal" class="text-gray-500 hover:text-red-600 text-2xl">&times;</button>
            </div>

            <!-- Konten Dinamis -->
            @if ($jenis === 'pengantar')
                <div class="space-y-3 text-sm text-gray-700">
                    <x-detail-item label="Nama" :value="$selectedSurat->nama" />
                    <x-detail-item label="Email" :value="$selectedSurat->email" />
                    <x-detail-item label="Keperluan" :value="$selectedSurat->keperluan" />
                    <x-detail-item label="Tanggal Pengajuan" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_pengajuan)->format('d M Y')" />
                    <x-detail-item label="Status" :value="ucfirst($selectedSurat->status)" />
                    <x-detail-item label="TTD RT" :value="$selectedSurat->file_ttd_rt ? 'Sudah' : 'Belum'" />
                    <x-detail-item label="TTD RW" :value="$selectedSurat->file_ttd_rw ? 'Sudah' : 'Belum'" />
                </div>
            @elseif ($jenis === 'kelahiran')
                <div class="space-y-3 text-sm text-gray-700">
                    <x-detail-item label="Nama Anak" :value="$selectedSurat->nama_anak" />
                    <x-detail-item label="Jenis Kelamin" :value="$selectedSurat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" />
                    <x-detail-item label="Tempat Lahir" :value="$selectedSurat->tempat_lahir" />
                    <x-detail-item label="Tanggal Lahir" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_lahir)->format('d M Y')" />
                    <x-detail-item label="Hari Lahir" :value="$selectedSurat->hari_lahir" />
                </div>
            @elseif ($jenis === 'kematian')
                <div class="space-y-3 text-sm text-gray-700">
                    <x-detail-item label="Nama Almarhum" :value="$selectedSurat->nama_warga" />
                    <x-detail-item label="Jenis Kelamin" :value="$selectedSurat->jenis_kelamin" />
                    <x-detail-item label="Tanggal Meninggal" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_meninggal)->format('d M Y')" />
                    <x-detail-item label="Sebab Kematian" :value="$selectedSurat->penyebab" />
                    <x-detail-item label="Tempat Pemakaman" :value="$selectedSurat->tempat_pemakaman" />
                </div>
            @endif

            <!-- QR Kode -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <p class="font-medium text-gray-700 mb-2">Kode Verifikasi</p>
                <div class="flex items-center justify-between">
                    <p class="font-mono px-3 py-1 bg-white border rounded text-gray-800">
                        {{ $selectedSurat->kode_verifikasi }}
                    </p>
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($selectedSurat->kode_verifikasi, 'QRCODE') }}"
                        class="w-20 h-20 border bg-white p-1 rounded" />
                </div>
            </div>

            <!-- Tanda Tangan Status -->
            <div class="bg-white border rounded-lg p-4">
                <p class="font-semibold mb-2">Status Tanda Tangan</p>
                @php
                    $ttd =
                        $selectedSurat->file_ttd_admin ?? ($selectedSurat->file_ttd_rw ?? $selectedSurat->file_ttd_rt);
                @endphp

                @if ($ttd)
                    <div class="flex items-center space-x-3">
                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(asset('storage/' . $ttd), 'QRCODE') }}"
                            class="w-16 h-16 border rounded bg-white p-1" />
                        <span
                            class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            ✔️ Sudah Ditandatangani
                        </span>
                    </div>
                @else
                    <span
                        class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                        ⏳ Belum Ditandatangani
                    </span>
                @endif
            </div>

            <!-- Tombol Footer -->
            <div class="pt-4 border-t">
                <button wire:click="closeDetailModal"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 w-full">
                    Tutup
                </button>
            </div>
        </div>
    </x-modal>
@endif
