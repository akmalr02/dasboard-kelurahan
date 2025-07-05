<div class="barcode-section">
    <div class="barcode-box">
        <p>Tanda Tangan Admin</p>
        @if (!empty($surat->file_ttd_admin))
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('ttd:' . $surat->file_ttd_admin, 'QRCODE') }}">
        @else
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('Belum Ada TTD Admin', 'QRCODE') }}">
        @endif
        <p>Admin Kelurahan</p>
    </div>
    <div class="barcode-box">
        <p>Kode Verifikasi</p>
        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($surat->kode_verifikasi ?? '-', 'QRCODE') }}">
        <p>{{ $surat->kode_verifikasi ?? '-' }}</p>
    </div>
</div>
