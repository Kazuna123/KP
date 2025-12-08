<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pernyataan Pemutihan</title>

    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            line-height: 1.5;
        }
        .kop-container {
            text-align: center;
            margin-bottom: 10px;
        }
        .kop-logo {
            width: 80px;
            margin-bottom: -10px;
        }
        .kop-title {
            font-size: 18px;
            font-weight: bold;
        }
        .kop-subtitle {
            font-size: 16px;
            font-weight: bold;
        }
        .kop-address {
            font-size: 13px;
            margin-bottom: 5px;
        }
        .line {
            border-bottom: 3px solid #000;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 10px;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- ========================= -->
    <!-- KOP SURAT -->
    <!-- ========================= -->
    <div class="kop-container">
        <img src="{{ public_path('jatim.png') }}" class="kop-logo">

        <div class="kop-title">PEMERINTAH PROVINSI JAWA TIMUR</div>
        <div class="kop-subtitle">DINAS PEKERJAAN UMUM BINA MARGA</div>
        <div class="kop-address">
            Jl. Gayung Kebonsari No. 167 Telp. 8280231, 8282691 <br>
            S U R A B A Y A
        </div>
    </div>

    <div class="line"></div>

    <!-- ========================= -->
    <!-- JUDUL -->
    <!-- ========================= -->
    <div class="judul-surat">
        SURAT PERNYATAAN <br>
        No. {{ $nomor_surat }}
    </div>

    <br>

    Saya yang bertanda tangan dibawah ini :

    <table style="margin-top: 10px;">
        <tr>
            <td width="150">Nama</td>
            <td>: {{ $kendaraan->pegawai->nama }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>: {{ $kendaraan->pegawai->nip }}</td>
        </tr>
        <tr>
            <td>Pekerjaan / Jabatan</td>
            <td>: {{ $kendaraan->pegawai->jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: Jl. Gayung Kebonsari No. 167, Surabaya</td>
        </tr>
    </table>

    Berdasarkan Surat Penunjukan Pemegang Kendaraan Dinas (SPPKD) adalah pengguna kendaraan dinas dengan data sebagai berikut :

    <table style="margin-top: 10px;">
        <tr><td width="150">No. Polisi Baru / Lama</td><td>: {{ $kendaraan->nomor_polisi }}</td></tr>
        <tr><td>Jenis</td><td>: {{ $kendaraan->jenis ?? '-' }}</td></tr>
        <tr><td>Merk / Type</td><td>: {{ $kendaraan->merk }} / {{ $kendaraan->tipe }}</td></tr>
        <tr><td>Tahun Pembuatan</td><td>: {{ $kendaraan->tahun }}</td></tr>
        <tr><td>No. Rangka</td><td>: {{ $kendaraan->nomor_rangka }}</td></tr>
        <tr><td>No. Mesin</td><td>: {{ $kendaraan->nomor_mesin }}</td></tr>
    </table>

    <br>

    <strong>MENYATAKAN</strong>

    <ol>
        <li>Bahwa saya bersedia menggunakan dan mengoperasikan kendaraan dinas semata-mata hanya untuk keperluan dinas.</li>
        <li>Bahwa saya bersedia memelihara dan merawat kendaraan dinas dimaksud agar selalu dalam keadaan baik dan siap pakai dan saya tidak akan menuntut ganti rugi apapun ataupun biaya pengganti atas segala biaya yang telah saya keluarkan berkaitan dengan pemeliharaan dan perawatan kendaraan dinas dimaksud.</li>
        <li>Bahwa saya bersedia menyerahkan/mengembalikan kendaraan dinas dimaksud kepada OPD melalui Sekretaris Dinas Pekerjaan Umum Bina Marga Provinsi Jawa Timur, apabila terjadi mutasi ke luar OPD atau pensiun.</li>
        <li>Bahwa saya bersedia bertanggung jawab penuh atas kejadian yang menimpa kendaraan dinas dimaksud berupa kehilangan, kerusakan dan atau akibat kecelakaan.</li>
        <li>Bahwa apabila dalam pemakaian kendaraan dinas sebagaimana dimaksud saya tidak menaati ketentuan Penggunaan Kendaraan Dinas Milik Pemerintah Provinsi Jawa Timur dan/atau melanggar peraturan perundang-undangan yang berlaku, maka saya bersedia diproses sesuai ketentuan yang berlaku.</li>
    </ol>

    Demikian pernyataan ini saya buat untuk dipergunakan sebagaimana mestinya.

    <br><br>

    <div style="text-align: right; margin-top: 40px;">
        Surabaya, {{ date('d-m-Y', strtotime($tanggal_surat)) }} <br>
        Sekretaris Dinas <br><br><br><br>

        <strong>{{ $sekretaris }}</strong><br>
    </div>


</body>
</html>
