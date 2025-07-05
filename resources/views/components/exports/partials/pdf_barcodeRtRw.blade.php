<div class="barcode-section">
    <div class="barcode-box">
        <p>Tanda Tangan RT</p>
        @if (!empty($surat->file_ttd_rt))
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('ttd:' . $surat->file_ttd_rt, 'QRCODE') }}">
        @else
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('Belum Ada TTD RT', 'QRCODE') }}">
        @endif
        <p>{{ $surat->pelapor->rt->name_RT ?? ($surat->ayah->rt->name_RT ?? ($surat->warga->rt->name_RT ?? '(Nama Ketua RT)')) }}
        </p>
    </div>
    <div class="barcode-box">
        <p>Tanda Tangan RW</p>
        @if (!empty($surat->file_ttd_rw))
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('ttd:' . $surat->file_ttd_rw, 'QRCODE') }}">
        @else
            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('Belum Ada TTD RW', 'QRCODE') }}">
        @endif
        <p>{{ $surat->pelapor->rw->name_RW ?? ($surat->ayah->rw->name_RW ?? ($surat->warga->rw->name_RW ?? '(Nama Ketua RW)')) }}
        </p>
    </div>
    <div class="barcode-box">
        <p>Kode Verifikasi</p>
        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($surat->kode_verifikasi ?? '-', 'QRCODE') }}">
        <p>{{ $surat->kode_verifikasi ?? '-' }}</p>
    </div>
</div>
