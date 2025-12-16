<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pernyataan Peminjaman Kendaraan</title>

    <style>
        body { font-family: 'Times New Roman', serif; font-size: 14px; line-height: 1.6; }

        /* KOP SURAT */
        .kop-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .kop-logo {
            width: 90px;
            margin-right: 15px;
        }
        .kop-text {
            text-align: center;
            flex: 1;
            margin-left: -90px; /* agar benar-benar simetris */
        }
        .kop-text div {
            line-height: 1.3;
        }
        .kop-title { font-size: 18px; font-weight: bold; }
        .kop-sub { font-size: 16px; font-weight: bold; }
        .kop-address { font-size: 13px; }

        .line {
            border-bottom: 3px solid #000;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
        }

        table { width: 100%; }

        .justify li {
            text-align: justify;
            line-height: 1.5;
            margin-bottom: 6px;
        }

        .justify {
            text-align: justify;
            font-size: 13px; /* bisa diganti 12px atau 11px */
            line-height: 1.5;
        }

        .tengah {
            text-align: center;
            font-weight: bold;
        }

        .table-small {
            font-size: 13px; /* bisa turunkan ke 12px atau 11px */
            line-height: 1.4;
        }
    </style>
</head>
<body>

    <!-- =============================== -->
    <!--   KOP SURAT RESMI (LOGO KIRI)  -->
    <!-- =============================== -->
    <table style="width: 100%; border-collapse: collapse;">
        <tr>

            <!-- LOGO -->
            <td style="width: 120px; text-align: center; vertical-align: top;">
                <img src="{{ public_path('jatim.png') }}" style="width: 95px;">
            </td>

            <!-- TEKS KOP SURAT -->
            <td style="text-align: center; line-height: 1.2; padding-top: 5px;">

                <div style="font-size: 20px; font-weight: 700;">
                    PEMERINTAH PROVINSI JAWA TIMUR
                </div>

                <div style="
                    font-size: 23px;
                    font-weight: 900;
                    margin-top: 3px;">
                    DINAS PEKERJAAN UMUM BINA MARGA
                </div>

                <div style="
                    font-size: 14px;
                    margin-top: 4px;">
                    Jl. Gayung Kebonsari No. 167 Telp. 8280231, 8282691
                </div>

                <div style="
                    font-size: 16px;
                    letter-spacing: 7px;
                    margin-top: 3px;
                    font-weight: 700;
                    text-decoration: underline;">
                    SURABAYA
                </div>

            </td>

        </tr>
    </table>

    <div class="line"></div>

    <!-- JUDUL -->
    <div class="judul">
        SURAT PERNYATAAN <br>
        No. {{ $nomor_surat ?? '____/____/____/____' }}
    </div>

    <p>Saya yang bertanda tangan dibawah ini :</p>

    <table class="table-small">
        <tr><td width="200">Nama</td><td>: {{ $pm->pegawai->nama }}</td></tr>
        <tr><td>NIP</td><td>: {{ $pm->pegawai->nip }}</td></tr>
        <tr><td>Pekerjaan / Jabatan</td><td>: {{ $pm->pegawai->jabatan ?? '-' }}</td></tr>
        <tr><td>Alamat</td><td>: Jl. Gayung Kebonsari No. 167, Surabaya</td></tr>
    </table>

    <p>Berdasarkan Surat Penunjukan Pemegang Kendaraan Dinas (SPPKD) adalah pengguna kendaraan dinas
       dengan data sebagai berikut :</p>

    <table class="table-small">
        <tr><td width="200">No. Polisi Baru / Lama</td><td>: {{ $pm->kendaraan->nomor_polisi }}</td></tr>
        <tr><td>Jenis</td><td>: {{ $pm->kendaraan->jenis }}</td></tr>
        <tr><td>Merk / Type</td><td>: {{ $pm->kendaraan->merk }} / {{ $pm->kendaraan->tipe }}</td></tr>
        <tr><td>Tahun Pembuatan</td><td>: {{ $pm->kendaraan->tahun }}</td></tr>
        <tr><td>No. Rangka</td><td>: {{ $pm->kendaraan->nomor_rangka }}</td></tr>
        <tr><td>No. Mesin</td><td>: {{ $pm->kendaraan->nomor_mesin }}</td></tr>
    </table>

    <p class="tengah"><strong>MENYATAKAN</strong></p>

    <ol class="justify">
        <li>Bahwa saya bersedia menggunakan dan mengoperasikan kendaraan dinas semata-mata hanya untuk keperluan dinas.</li>
        <li>Bahwa saya bersedia memelihara dan merawat kendaraan dinas dimaksud agar selalu dalam keadaan baik dan siap pakai dan saya tidak akan menuntut ganti rugi apapun ataupun biaya pengganti atas segala biaya yang telah saya keluarkan berkaitan dengan pemeliharaan dan perawatan kendaraan dinas dimaksud.</li>
        <li>Bahwa saya bersedia menyerahkan/mengembalikan kendaraan dinas dimaksud kepada OPD melalui Sekretaris Dinas Pekerjaan Umum Bina Marga Provinsi Jawa Timur, apabila terjadi mutasi ke luar OPD atau pensiun.</li>
        <li>Bahwa saya bersedia bertanggung jawab penuh atas kejadian yang menimpa kendaraan dinas dimaksud berupa kehilangan, kerusakan dan atau akibat kecelakaan.</li>
        <li>Bahwa apabila dalam pemakaian kendaraan dinas sebagaimana dimaksud saya tidak menaati ketentuan Penggunaan Kendaraan Dinas Milik Pemerintah Provinsi Jawa Timur dan/atau melanggar peraturan perundang-undangan yang berlaku, maka saya bersedia diproses sesuai ketentuan yang berlaku.</li>
    </ol>

    <p>Demikian surat pernyataan ini saya buat dengan sebenarnya.</p>

    <div style="text-align: right; margin-top: 14px;">
        Surabaya, {{ $tanggal_surat ?? date('Y-m-d') }} <br>
        Yang Membuat Pernyataan<br><br><br><br>

        <strong>{{ $pm->pegawai->nama }}</strong><br>
        {{ $pm->pegawai->nip }}
    </div>

</body>
</html>
