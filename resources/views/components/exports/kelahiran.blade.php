<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Kelahiran - Kelurahan Kramat-Senen</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header-content {
            position: relative;
            min-height: 2em;
            padding-left: 0.1em;
        }

        .logo {
            position: absolute;
            left: 0;
            top: 0;
        }

        .logo img {
            width: 70px;
            height: 70px;
        }

        .header-text {
            text-align: center;
            padding-top: 5px;
        }

        .nama-kelurahan {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
            text-transform: uppercase;
        }

        .alamat-kelurahan {
            font-size: 10px;
            color: #555;
            margin: 2px 0;
        }

        .judul {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
            color: #2c3e50;
        }

        .content {
            line-height: 1.8;
            margin: 30px 0;
        }

        .content p {
            margin: 8px 0;
        }

        .content .label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }

        .content .value {
            display: inline-block;
        }

        .verification-section {
            margin-top: 40px;
        }

        .verification-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
        }

        .barcode-container {
            text-align: center;
            margin: 20px 0;
        }

        .barcode {
            display: inline-block;
            margin: 0 20px;
        }

        .barcode p {
            font-size: 10px;
            margin: 5px 0;
            color: #666;
        }

        .barcode img {
            width: 80px;
            height: 80px;
        }

        .kode-verifikasi {
            border-radius: 3px;
            font-family: monospace;
            font-weight: bold;
        }

        @media print {
            body {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-content">
            <div class="logo">
                @if (file_exists(public_path('img/logo.png')))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo.png'))) }}"
                        alt="Logo Kelurahan">
                @endif
            </div>
            <div class="header-text">
                <h1 class="nama-kelurahan">Kelurahan Kramat-Senen</h1>
                <p class="alamat-kelurahan">Kecamatan Senen, Jakarta Pusat</p>
                <p class="alamat-kelurahan">DKI Jakarta</p>
            </div>
        </div>
    </div>

    <div class="judul">SURAT KETERANGAN KELAHIRAN</div>

    <div class="content">
        <p>
            <span class="label">Nama Anak</span>
            <span class="value">: {{ $surat->nama_anak }}</span>
        </p>
        <p>
            <span class="label">Jenis Kelamin :</span>
            <span class="value">: {{ $surat->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
        </p>
        <p>
            <span class="label">Tanggal Lahir :</span>
            <span class="value">: {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d M Y') }}</span>
        </p>
        <p>
            <span class="label">Hari Lahir :</span>
            <span class="value">: {{ $surat->hari_lahir }}</span>
        </p>
        <p>
            <span class="label">Nama Ayah :</span>
            <span class="value">: {{ $surat->ayah->name ?? '-' }}</span>
        </p>
        <p>
            <span class="label">Nama Ibu :</span>
            <span class="value">: {{ $surat->ibu->name ?? '-' }}</span>
        </p>
        <p>
            <span class="label">RT/RW :</span>
            <span class="value">: {{ $surat->ayah->rt->no_RT ?? '-' }}/{{ $surat->ayah->rw->no_RW ?? '-' }}</span>
        </p>
        <p>
            <span class="label">Kode Verifikasi :</span>
            <span class="value">: {{ $surat->kode_verifikasi }}</span>
        </p>
    </div>

    <div class="verification-section">
        <div class="verification-title">VERIFIKASI DIGITAL</div>
        <div class="barcode-container">
            <div class="barcode">
                <p>Barcode Kode Verifikasi</p>
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($surat->kode_verifikasi, 'QRCODE') }}"
                    alt="Barcode Verifikasi">
            </div>
            <div class="barcode">
                <p>Barcode Tanda Tangan</p>
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('ttd:' . $surat->file_ttd_admin, 'QRCODE') }}"
                    alt="Barcode TTD">
            </div>
        </div>
    </div>
</body>

</html>
