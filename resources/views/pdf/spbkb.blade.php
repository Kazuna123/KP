<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat SPBKB</title>

    <style>
        @page {
            margin: 25px 30px; /* margin kecil supaya 1 halaman */
        }
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12.2px;
            line-height: 1.35;
        }
        .kop-container {
            text-align: center;
            margin-bottom: 0px;
        }
        .kop-logo {
            width: 65px;
            margin-bottom: -5px;
            margin-top: -10px;
        }
        .kop-title {
            font-size: 15px;
            font-weight: bold;
        }
        .kop-subtitle {
            font-size: 14px;
            font-weight: bold;
        }
        .kop-address {
            font-size: 11px;
            margin-top: -3px;
        }
        .line {
            border-bottom: 2px solid #000;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 2px;
            margin-bottom: 6px;
            font-size: 14px;
        }
        table { width: 100%; }
        table td { vertical-align: top; padding: 1px 0; }
        ol { margin-top: 5px; margin-bottom: 5px; padding-left: 17px; }
        ol li { margin-bottom: 3px; }
    </style>
</head>
<body>

    <!-- ====================== -->
    <!-- KOP SURAT -->
    <!-- ====================== -->
    <div class="kop-container">
        <img src="{{ public_path('jatim.png') }}" class="kop-logo">

        <div class="kop-title">PEMERINTAH PROVINSI JAWA TIMUR</div>
        <div class="kop-subtitle">DINAS PEKERJAAN UMUM BINA MARGA</div>
        <div class="kop-address">
            Jl. Gayung Kebonsari No. 167 Telp. 8280231, 8282691 – SURABAYA
        </div>
    </div>

    <div class="line"></div>

    <!-- ====================== -->
    <!-- JUDUL -->
    <!-- ====================== -->
    <div class="judul-surat">
        SURAT PERNYATAAN<br>
        PENGGUNAAN BAHAN BAKAR (SPBKB)<br>
        No. {{ $nomor_surat }}
    </div>

    <p style="margin-top: 5px;">
        Yang bertanda tangan di bawah ini:
    </p>

    <table>
        <tr><td width="150">Nama</td><td>: {{ $kendaraan->pegawai->nama }}</td></tr>
        <tr><td>NIP</td><td>: {{ $kendaraan->pegawai->nip }}</td></tr>
        <tr><td>Jabatan</td><td>: {{ $kendaraan->pegawai->jabatan ?? '-' }}</td></tr>
        <tr><td>Alamat</td><td>: Jl. Gayung Kebonsari No. 167, Surabaya</td></tr>
    </table>

    <p style="margin-top: 6px;">
        Adalah pengguna kendaraan dinas dengan rincian sebagai berikut:
    </p>

    <table>
        <tr><td width="150">No. Polisi</td><td>: {{ $kendaraan->nomor_polisi }}</td></tr>
        <tr><td>Jenis</td><td>: {{ $kendaraan->jenis ?? '-' }}</td></tr>
        <tr><td>Merk / Tipe</td><td>: {{ $kendaraan->merk }} / {{ $kendaraan->tipe }}</td></tr>
        <tr><td>Tahun Perolehan</td><td>: {{ $kendaraan->tahun }}</td></tr>
    </table>

    <p style="margin-top: 6px; margin-bottom: 5px;">
        Dengan ini saya menyatakan bahwa:
    </p>

    <ol>
        <li>Benar saya sebagai pengguna kendaraan dinas sebagaimana tercantum di atas.</li>
        <li>Bersedia bertanggung jawab sepenuhnya atas penggunaan bahan bakar yang diberikan.</li>
        <li>Bahan bakar yang diterima hanya digunakan untuk keperluan operasional kedinasan.</li>
        <li>Tidak menggunakan bahan bakar tersebut untuk kepentingan pribadi di luar tugas kedinasan.</li>
        <li>Apabila melanggar ketentuan tersebut, saya bersedia menerima sanksi sesuai aturan yang berlaku.</li>
    </ol>

    <p style="margin-top: 8px;">
        Demikian surat pernyataan ini saya buat dengan sebenarnya tanpa adanya tekanan dari pihak manapun.
    </p>

    <br>

    <div style="text-align: right; margin-top: 40px;">
        Surabaya, {{ date('d-m-Y', strtotime($tanggal_surat)) }} <br>
        Sekretaris Dinas <br><br><br><br>

        <strong>{{ $sekretaris }}</strong><br>
    </div>


</body>
</html>
