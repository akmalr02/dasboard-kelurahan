@if ($showDetailModal && $selectedSurat)
    <x-modal wire:model="showDetailModal" maxWidth="max-w-4xl">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <div class="flex gap-3 items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Detail Surat {{ ucfirst($jenis) }}</h2>
                    <p class="text-sm text-gray-500">Informasi lengkap surat jenis: {{ ucfirst($jenis) }}</p>
                </div>
            </div>
            <button wire:click="closeDetailModal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-10 max-h-[80vh] overflow-y-auto text-sm text-gray-700">

            <!-- Informasi Umum -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if ($jenis === 'pengantar')
                    <x-detail-item label="Nama" :value="$selectedSurat->nama" />
                    <x-detail-item label="NIK" :value="$selectedSurat->NIK" />
                    <x-detail-item label="NKK" :value="$selectedSurat->NKK" />
                    <x-detail-item label="Jenis Kelamin" :value="$selectedSurat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" />
                    <x-detail-item label="Tempat Lahir" :value="$selectedSurat->tempat_lahir" />
                    <x-detail-item label="Tanggal Lahir" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_lahir)->format('d M Y')" />
                    <x-detail-item label="Status Perkawinan" :value="$selectedSurat->status_perkawinan" />
                    <x-detail-item label="Kewarganegaraan" :value="$selectedSurat->kewarganegaraan" />
                    <x-detail-item label="Agama" :value="$selectedSurat->agama" />
                    <x-detail-item label="Pekerjaan" :value="$selectedSurat->pekerjaan" />
                    <x-detail-item label="Alamat" :value="$selectedSurat->alamat" />
                    <x-detail-item label="Keperluan" :value="$selectedSurat->keperluan" />
                    <x-detail-item label="Email" :value="$selectedSurat->email" />
                    <x-detail-item label="Status" :value="ucfirst($selectedSurat->status)" />
                    <x-detail-item label="Tanggal Pengajuan" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_pengajuan)->format('d M Y')" />
                    <x-detail-item label="TTD RT" :value="$selectedSurat->file_ttd_rt ? 'Sudah' : 'Belum'" />
                    <x-detail-item label="TTD RW" :value="$selectedSurat->file_ttd_rw ? 'Sudah' : 'Belum'" />
                    <x-detail-item label="RT" :value="$selectedSurat->rt?->no_RT ?? '-'" />
                    <x-detail-item label="RW" :value="$selectedSurat->rw?->no_RW ?? '-'" />
                    <x-detail-item label="File PDF" :value="$selectedSurat->file_pdf ? 'Tersedia' : 'Tidak ada'" />
                    <x-detail-item label="Foto KTP" :value="$selectedSurat->foto_ktp ? 'Tersedia' : 'Tidak ada'" />
                @elseif ($jenis === 'kelahiran')
                    <x-detail-item label="Nama Anak" :value="$selectedSurat->nama_anak" />
                    <x-detail-item label="Anak ke" :value="$selectedSurat->anak_ke" />
                    <x-detail-item label="Jenis Kelamin" :value="$selectedSurat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" />
                    <x-detail-item label="Tempat Lahir" :value="$selectedSurat->tempat_lahir" />
                    <x-detail-item label="Tanggal Lahir" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_lahir)->format('d M Y')" />
                    <x-detail-item label="Hari Lahir" :value="$selectedSurat->hari_lahir" />
                    <x-detail-item label="Nama Ayah" :value="$selectedSurat->ayah?->name ?? '-'" />
                    <x-detail-item label="Nama Ibu" :value="$selectedSurat->ibu?->name ?? '-'" />
                    <x-detail-item label="Diverifikasi Admin" :value="$selectedSurat->admin?->name ?? '-'" />
                    <x-detail-item label="Tanggal Update" :value="\Carbon\Carbon::parse($selectedSurat->updated_at)->format('d M Y')" />
                @elseif ($jenis === 'kematian')
                    <x-detail-item label="Nama Almarhum" :value="$selectedSurat->nama_warga" />
                    <x-detail-item label="Jenis Kelamin" :value="$selectedSurat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" />
                    <x-detail-item label="Tempat Lahir" :value="$selectedSurat->tempat_lahir" />
                    <x-detail-item label="Tanggal Lahir" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_lahir)->format('d M Y')" />
                    <x-detail-item label="Agama" :value="$selectedSurat->agama" />
                    <x-detail-item label="Alamat" :value="$selectedSurat->alamat" />
                    <x-detail-item label="Hari Meninggal" :value="$selectedSurat->hari_meninggal" />
                    <x-detail-item label="Tanggal Meninggal" :value="\Carbon\Carbon::parse($selectedSurat->tanggal_meninggal)->format('d M Y')" />
                    <x-detail-item label="Jam Meninggal" :value="$selectedSurat->jam_meninggal" />
                    <x-detail-item label="Penyebab" :value="$selectedSurat->penyebab" />
                    <x-detail-item label="Tempat Pemakaman" :value="$selectedSurat->tempat_pemakaman" />
                    <x-detail-item label="Dilaporkan Oleh" :value="$selectedSurat->pelapor?->name ?? '-'" />
                    <x-detail-item label="Diverifikasi Admin" :value="$selectedSurat->admin?->name ?? '-'" />
                    <x-detail-item label="Tanggal Update" :value="\Carbon\Carbon::parse($selectedSurat->updated_at)->format('d M Y')" />
                @endif
            </div>

            <!-- Kode Verifikasi -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-2 border-b pb-1">Kode Verifikasi</h3>
                <div class="flex flex-col md:flex-row md:items-center md:space-x-6 bg-gray-50 p-4 rounded-lg">
                    <div class="mb-4 md:mb-0">
                        <label class="block text-sm text-gray-600 mb-1">Kode</label>
                        <p class="font-mono bg-white border px-4 py-2 rounded text-lg text-gray-800">
                            {{ $selectedSurat->kode_verifikasi }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">QR Code</label>
                        <div class="bg-white p-3 border rounded-lg">
                            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($selectedSurat->kode_verifikasi, 'QRCODE') }}"
                                class="w-24 h-24">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Tanda Tangan -->
            <div>
                <h3 class="font-semibold text-gray-900 mb-2 border-b pb-1">Status Tanda Tangan</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    @php
                        $ttd =
                            $selectedSurat->file_ttd_admin ??
                            ($selectedSurat->file_ttd_rw ?? $selectedSurat->file_ttd_rt);
                    @endphp
                    @if ($ttd)
                        <div class="flex items-center gap-4">
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
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end items-center gap-3 p-6 border-t bg-gray-50">
            <button wire:click="closeDetailModal"
                class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">Tutup</button>
        </div>
    </x-modal>
@endif
