<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\MaintenanceKendaraan;
use Illuminate\Http\Request;

class MaintenanceKendaraanController extends Controller
{
    public function index(Request $request)
    {
        // Dropdown kendaraan
        $kendaraans = Kendaraan::orderBy('merk')->get();

        // default: tampilan semua maintenance
        $maintenances = MaintenanceKendaraan::with('kendaraan')
            ->latest()
            ->get();

        $kendaraan = null;
        // $maintenances = collect();

        if ($request->kendaraan_id) {
            $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

            $maintenances = MaintenanceKendaraan::where('kendaraan_id', $kendaraan->id)
                ->latest()
                ->get();
        }

        return view('maintenance.index', compact(
            'kendaraans',
            'kendaraan',
            'maintenances'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal'      => 'required|date',
            'keterangan'   => 'required|string',
        ]);

        MaintenanceKendaraan::create([
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal'      => $request->tanggal,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect()
            ->route('maintenance.index', ['kendaraan_id' => $request->kendaraan_id])
            ->with('success', 'Data maintenance berhasil ditambahkan');
    }

    public function edit($id)
    {
        $maintenance = MaintenanceKendaraan::with('kendaraan')->findOrFail($id);
        return view('maintenance.edit', compact('maintenance'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $maintenance = MaintenanceKendaraan::findOrFail($id);

        $maintenance->update([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('maintenance.index')
                        ->with('success', 'Data maintenance berhasil diperbarui');
    }


    public function destroy($id)
    {
        $maintenance = MaintenanceKendaraan::findOrFail($id);
        $kendaraanId = $maintenance->kendaraan_id;

        $maintenance->delete();

        return redirect()
            ->route('maintenance.index', ['kendaraan_id' => $kendaraanId])
            ->with('success', 'Data maintenance berhasil dihapus');
    }
}
