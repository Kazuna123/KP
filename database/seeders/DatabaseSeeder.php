<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\PencatatanTanggal;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1) Buat data master
        $pegawai = Pegawai::factory()->count(20)->create();
        $kendaraan = Kendaraan::factory()->count(12)->create();

        // 2) Buat transaksi: gunakan pegawai & kendaraan dari yg dibuat
        //    agar lebih realistis, acak beberapa transaksi per kendaraan
        $transaksiCount = 30;
        $transaksiList = collect();

        for ($i = 0; $i < $transaksiCount; $i++) {
            // ambil random pegawai & kendaraan
            $p = $pegawai->random();
            $k = $kendaraan->random();

            // tentukan tanggal mulai & selesai (beberapa selesai)
            $mulai = now()->subDays(rand(0, 30))->toDateString();
            $selesai = (rand(0,1)) ? now()->subDays(rand(0, 29))->toDateString() : null;

            $jenis = rand(0,6) > 1 ? 'pinjam' : 'servis'; // lebih banyak pinjam
            $status = $selesai ? 'selesai' : (rand(0,10) > 1 ? 'ongoing' : 'dibatalkan');

            $tr = Transaksi::create([
                'pegawai_id' => $p->id,
                'kendaraan_id' => $k->id,
                'jenis' => $jenis,
                'tujuan' => $this->randomTujuan(),
                'tanggal_mulai' => $mulai,
                'tanggal_selesai' => $selesai,
                'status' => $status,
                'keterangan' => null,
            ]);

            // jika transaksi bertipe pinjam dan belum selesai, set status kendaraan jadi dipinjam
            if($jenis === 'pinjam' && !$selesai) {
                $k->update(['status' => 'dipinjam']);
            }

            $transaksiList->push($tr);
        }

        // 3) Untuk tiap transaksi, buat 1-4 pencatatan tanggal
        foreach ($transaksiList as $tr) {
            $countNotes = rand(1,4);
            for ($j = 0; $j < $countNotes; $j++) {
                PencatatanTanggal::create([
                    'transaksi_id' => $tr->id,
                    'tanggal' => now()->subDays(rand(0, 30))->toDateString(),
                    'catatan' => (rand(0,1) ? 'Catatan kegiatan' : null),
                ]);
            }
        }
    }

    private function randomTujuan()
    {
        $arr = [
            'Urusan dinas',
            'Monitoring jalan',
            'Rapat koordinasi',
            'Inspeksi lapangan',
            'Perbaikan jembatan',
            'Pengukuran proyek',
            'Distribusi alat',
        ];
        return $arr[array_rand($arr)];
    }
}
