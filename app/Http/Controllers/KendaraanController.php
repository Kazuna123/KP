<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\MaintenanceKendaraan;
use App\Models\PajakKendaraan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $kendaraans = Kendaraan::with('pegawai')
            ->when($q, function($query) use ($q) {
                $query->where('nomor_polisi', 'like', "%$q%")
                    ->orWhere('merk', 'like', "%$q%")
                    ->orWhere('tipe', 'like', "%$q%")
                    ->orWhereHas('pegawai', function($p) use ($q){
                        $p->where('nama','like',"%$q%")
                          ->orWhere('nip','like',"%$q%");
                    });
            })
            ->orderBy('id','desc')
            ->paginate(12);

        $pegawais = Pegawai::orderBy('nama')->get();
        $sekretaris = ['Sekretaris A','Sekretaris B','Sekretaris C'];

        return view('kendaraan.index', compact('kendaraans','sekretaris','pegawais','q'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|string|max:50',
            'nomor_polisi' => 'required|string|max:50',
            'merk' => 'required|string|max:100',
            'tipe' => 'nullable|string|max:100',
            'tahun' => 'nullable|integer',
            'nomor_rangka' => 'nullable|string',
            'nomor_mesin' => 'nullable|string',
            'status' => 'required|in:tersedia,dipinjam,maintenance',
            'kondisi'        => 'required|in:baik,rusak_ringan,rusak_berat',
            'foto_kendaraan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_stnk'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto kendaraan
        if ($request->hasFile('foto_kendaraan')) {
            $validated['foto_kendaraan'] =
                $request->file('foto_kendaraan')->store('kendaraan', 'public');
        }

        // upload foto stnk
        if ($request->hasFile('foto_stnk')) {
            $validated['foto_stnk'] =
                $request->file('foto_stnk')->store('kendaraan', 'public');
        }

        Kendaraan::create($validated);

        return redirect()->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil ditambahkan!');
    }



    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'jenis' => 'required',
            'nomor_polisi' => 'required|unique:kendaraan,nomor_polisi,' . $kendaraan->id,
            'merk' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'nomor_rangka' => 'nullable',
            'nomor_mesin' => 'nullable',
            'status' => 'required',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'foto_kendaraan' => 'nullable|image|max:2048',
            'foto_stnk' => 'nullable|image|max:2048',
        ]);

        // 🔁 GANTI FOTO KENDARAAN
        if ($request->hasFile('foto_kendaraan')) {
            if ($kendaraan->foto_kendaraan) {
                Storage::disk('public')->delete($kendaraan->foto_kendaraan);
            }
            $validated['foto_kendaraan'] =
                $request->file('foto_kendaraan')->store('kendaraan', 'public');
        }

        // 🔁 GANTI FOTO STNK
        if ($request->hasFile('foto_stnk')) {
            if ($kendaraan->foto_stnk) {
                Storage::disk('public')->delete($kendaraan->foto_stnk);
            }
            $validated['foto_stnk'] =
                $request->file('foto_stnk')->store('kendaraan', 'public');
        }

        $kendaraan->update($validated);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui!');
    }



    public function destroy(Kendaraan $kendaraan)
    {
        // if ($kendaraan->foto_kendaraan) {
        //     Storage::disk('public')->delete($kendaraan->foto_kendaraan);
        // }

        // if ($kendaraan->foto_stnk) {
        //     Storage::disk('public')->delete($kendaraan->foto_stnk);
        // }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil dihapus.');
    }
}
