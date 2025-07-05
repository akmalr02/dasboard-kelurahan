<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar - Kelurahan Kramat-Senen</title>
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

    <div class="judul">SURAT PENGANTAR</div>
    <div class="nomor-surat">
        No: {{ $surat->kode_verifikasi }}/SP/{{ date('Y', strtotime($surat->tanggal_pengajuan)) }}
    </div>

    <table class="content-table">
        <tr>
            <td class="left-col">
                <p><strong>Nama</strong>: {{ $surat->nama }}</p>
                <p><strong>NIK</strong>: {{ $surat->NIK }}</p>
                <p><strong>NKK</strong>: {{ $surat->NKK }}</p>
                <p><strong>Jenis Kelamin</strong>: {{ $surat->jenis_kelamin }}</p>
                <p><strong>Tempat, Tgl Lahir</strong>: {{ $surat->tempat_lahir }}, {{ $surat->tanggal_lahir }}</p>
                <p><strong>Status Perkawinan</strong>: {{ $surat->status_perkawinan }}</p>
            </td>
            <td class="right-col">
                <p><strong>Agama</strong>: {{ $surat->agama }}</p>
                <p><strong>Pekerjaan</strong>: {{ $surat->pekerjaan }}</p>
                <p><strong>Kewarganegaraan</strong>: {{ $surat->kewarganegaraan }}</p>
                <p><strong>Alamat</strong>: {{ $surat->alamat }}</p>
                <p><strong>RT/RW</strong>: {{ $surat->warga->rt->no_RT ?? '-' }}/{{ $surat->warga->rw->no_RW ?? '-' }}
                </p>
                <p><strong>Email</strong>: {{ $surat->email }}</p>
            </td>
        </tr>
    </table>

    <p><strong>Keperluan</strong>: {{ $surat->keperluan }}</p>
    <p><strong>Tanggal Pengajuan</strong>: {{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('d M Y') }}</p>
    <p><strong>Status</strong>: {{ ucfirst($surat->status) }}</p>

    <div class="pernyataan">
        Saya yang bertanda tangan di bawah ini menyatakan bahwa data di atas adalah benar dan digunakan untuk keperluan
        yang disebutkan.
    </div>

    @include('components.exports.partials.pdf_barcodeRtRw')
    @include('components.exports.partials.pdf_footer')
</body>

</html>
