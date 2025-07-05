<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Kematian - Kelurahan Kramat-Senen</title>
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
            padding-bottom: 10px;
        }

        .logo img {
            width: 70px;
            height: 70px;
            float: left;
        }

        .header-text h1 {
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
        }

        .judul {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
        }

        .nomor-surat {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .content-table td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .left-col,
        .right-col {
            width: 50%;
        }

        .verification-section {
            margin-top: 30px;
            border-top: 1px dashed #ccc;
            padding-top: 20px;
        }

        .barcode-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .barcode {
            text-align: center;
        }

        .barcode img {
            width: 80px;
            height: 80px;
        }

        .barcode-section {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            margin-top: 30px;
            width: 100%;
        }

        .barcode-box {
            text-align: center;
            width: 45%;
            display: inline-block;
        }

        .barcode-box p {
            margin: 5px 0;
            font-size: 11px;
            font-weight: bold;
        }

        .barcode-box img {
            width: 60px;
            height: 60px;
            margin: 5px 0;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .verification-barcode {
            text-align: center;
            margin-top: 20px;
            width: 100%;
        }

        .verification-barcode .barcode-box {
            width: 200px;
            margin: 0 auto;
            display: inline-block;
        }

        .verification-barcode .barcode-box img {
            width: 80px;
            height: 80px;
        }

        .pernyataan {
            margin-top: 30px;
            padding: 10px;
            background-color: #f8f9fa;
            border-left: 3px solid #333;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>
    @include('components.exports.partials.pdf_header')

    <div class="judul">SURAT KETERANGAN KEMATIAN</div>
    <div class="nomor-surat">
        No: {{ $surat->kode_verifikasi }}/SK/{{ date('Y', strtotime($surat->tanggal_meninggal)) }}
    </div>

    <table class="content-table">
        <tr>
            <td class="left-col">
                <p><strong>Nama Almarhum</strong>: {{ $surat->nama_warga }}</p>
                <p><strong>Tempat Lahir</strong>: {{ $surat->tempat_lahir ?? '-' }}</p>
                <p><strong>Tanggal Lahir</strong>:
                    {{ $surat->tanggal_lahir ? \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d M Y') : '-' }}
                </p>
                <p><strong>Jenis Kelamin</strong>: {{ $surat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                <p><strong>Agama</strong>: {{ $surat->agama }}</p>
                <p><strong>Alamat</strong>: {{ $surat->alamat ?? '-' }}</p>
            </td>
            <td class="right-col">
                <p><strong>Hari Meninggal</strong>: {{ $surat->hari_meninggal }}</p>
                <p><strong>Tanggal Meninggal</strong>:
                    {{ \Carbon\Carbon::parse($surat->tanggal_meninggal)->format('d M Y') }}</p>
                <p><strong>Jam Meninggal</strong>: {{ $surat->jam_meninggal }}</p>
                <p><strong>Penyebab Kematian</strong>: {{ $surat->penyebab ?? '-' }}</p>
                <p><strong>Tempat Pemakaman</strong>: {{ $surat->tempat_pemakaman ?? '-' }}</p>
                <p><strong>RT/RW</strong>:
                    {{ $surat->pelapor->rt->no_RT ?? '-' }}/{{ $surat->pelapor->rw->no_RW ?? '-' }}</p>
            </td>
        </tr>
    </table>

    <!-- Informasi Pelapor -->
    <div class="pelapor-section">
        <h4>Data Pelapor:</h4>
        <table class="content-table">
            <tr>
                <p><strong>Nama Pelapor</strong>: {{ $surat->pelapor->name ?? '-' }}</p>
                <p><strong>NIK Pelapor</strong>: {{ $surat->pelapor->NIK ?? '-' }}</p>
                <p><strong>Alamat Pelapor</strong>: {{ $surat->pelapor->alamat ?? '-' }}</p>
            </tr>
        </table>
    </div>

    <div class="pernyataan">
        Saya yang bertanda tangan di bawah ini menyatakan bahwa data di atas adalah benar dan digunakan untuk keperluan
        yang disebutkan.
    </div>

    @include('components.exports.partials.pdf_barcodeAdmin')
    @include('components.exports.partials.pdf_footer')
</body>

</html>
