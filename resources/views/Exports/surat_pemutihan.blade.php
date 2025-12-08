<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* sesuaikan styling minimal supaya Excel menampilkan rapi */
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        .header { text-align:center; font-weight:bold; }
        .section { margin-top:12px; }
        .label { width:150px; display:inline-block; vertical-align:top; }
    </style>
</head>
<body>
    <div class="header">
        PEMERINTAH PROVINSI JAWA TIMUR<br/>
        DINAS PEKERJAAN UMUM BINA MARGA<br/>
        Jl. Gayung Kebonsari No. 167 Telp. 8280231, 8282691
        <h3>SURAT PERNYATAAN</h3>
        No. {{ $nomor_surat ?? '' }}
    </div>

    <div class="section">
        <p>Yang bertanda tangan di bawah ini :</p>
        <p><span class="label">Nama</span>: {{ $kendaraan->pegawai->nama ?? $kendaraan->nama }}</p>
        <p><span class="label">NIP</span>: {{ $kendaraan->pegawai->nip ?? $kendaraan->nip }}</p>
        <p><span class="label">Pekerjaan / Jabatan</span>: {{ $kendaraan->pegawai->jabatan ?? $kendaraan->jabatan }}</p>
    </div>

    <div class="section">
        <p>Berdasarkan Surat Penunjukan Pemegang Kendaraan Dinas (SPPKD) adalah pengguna kendaraan dinas dengan data sebagai berikut :</p>
        <p><span class="label">No. Polisi</span>: {{ $kendaraan->nomor_polisi }}</p>
        <p><span class="label">Jenis</span>: {{ $kendaraan->jenis }}</p>
        <p><span class="label">Merk / Type</span>: {{ $kendaraan->merk }} / {{ $kendaraan->type }}</p>
        <p><span class="label">Tahun</span>: {{ $kendaraan->tahun }}</p>
        <p><span class="label">No. Rangka</span>: {{ $kendaraan->nomor_rangka }}</p>
        <p><span class="label">No. Mesin</span>: {{ $kendaraan->nomor_mesin }}</p>
    </div>

    <!-- Sisipkan teks pernyataan sesuai template -->
    <div class="section">
        <p>Demikian pernyataan ini saya buat ...</p>
    </div>

    <div style="margin-top:30px;">
        <div style="float:right; text-align:center;">
            <p>Surabaya, {{ \Carbon\Carbon::parse($tanggal_surat)->format('d F Y') }}</p>
            <p>Yang Membuat Pernyataan</p>
            <br><br><br>
            <p>{{ $kendaraan->pegawai->nama ?? $kendaraan->nama }}</p>
            <p>{{ $kendaraan->pegawai->nip ?? $kendaraan->nip }}</p>
        </div>
    </div>
</body>
</html>
