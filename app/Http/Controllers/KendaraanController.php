<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pegawai;
use App\Models\ArsipSurat;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Barryvdh\DomPDF\Facade\Pdf;

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
        ]);

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
        $validated = $request->validate([
            'jenis' => 'required',
            'nomor_polisi' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|numeric',
            'nomor_rangka' => 'nullable',
            'nomor_mesin' => 'nullable',
            'status' => 'required',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($validated);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }


    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil dihapus.');
    }


    /* ============================================================
     * EXPORT EXCEL PEMUTIHAN
     * ============================================================ */
    public function exportPemutihan(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'sekretaris' => 'required'
        ]);

        ArsipSurat::create([
            'kendaraan_id' => $kendaraan->id,
            'jenis' => 'pemutihan',
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'sekretaris' => $request->sekretaris,
            'user_id' => auth()->id(),
        ]);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'SURAT PERNYATAAN PEMUTIHAN');
        $sheet->setCellValue('A3', 'Nomor Surat');
        $sheet->setCellValue('B3', $request->nomor_surat);
        $sheet->setCellValue('A4', 'Tanggal Surat');
        $sheet->setCellValue('B4', $request->tanggal_surat);

        $sheet->setCellValue('A6', 'Nama Pegawai');
        $sheet->setCellValue('B6', $kendaraan->pegawai->nama ?? '-');

        $sheet->setCellValue('A7', 'NIP');
        $sheet->setCellValue('B7', $kendaraan->pegawai->nip ?? '-');

        $sheet->setCellValue('A8', 'Nomor Polisi');
        $sheet->setCellValue('B8', $kendaraan->nomor_polisi);

        $sheet->setCellValue('A9', 'Merk');
        $sheet->setCellValue('B9', $kendaraan->merk);

        $sheet->setCellValue('A10', 'Tipe');
        $sheet->setCellValue('B10', $kendaraan->tipe);

        $sheet->setCellValue('A11', 'Tahun');
        $sheet->setCellValue('B11', $kendaraan->tahun);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'surat_pemutihan_'.$kendaraan->nomor_polisi.'.xlsx';

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }


    /* ============================================================
     * EXPORT EXCEL SPBKB
     * ============================================================ */
    public function exportSpbkb(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'sekretaris' => 'required'
        ]);

        ArsipSurat::create([
            'kendaraan_id' => $kendaraan->id,
            'jenis' => 'spbkb',
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'sekretaris' => $request->sekretaris,
            'user_id' => auth()->id(),
        ]);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'SURAT SPBKB');
        $sheet->setCellValue('A3', 'Nomor Surat');
        $sheet->setCellValue('B3', $request->nomor_surat);
        $sheet->setCellValue('A4', 'Tanggal Surat');
        $sheet->setCellValue('B4', $request->tanggal_surat);

        $sheet->setCellValue('A6', 'Nama Pegawai');
        $sheet->setCellValue('B6', $kendaraan->pegawai->nama ?? '-');

        $sheet->setCellValue('A7', 'Nomor Polisi');
        $sheet->setCellValue('B7', $kendaraan->nomor_polisi);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'spbkb_'.$kendaraan->nomor_polisi.'.xlsx';

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }


    /* ============================================================
     *  CETAK PDF PEMUTIHAN
     * ============================================================ */
    public function cetakPemutihan(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'sekretaris' => 'required'
        ]);

        $data = [
            'kendaraan' => $kendaraan->load('pegawai'),
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'sekretaris' => $request->sekretaris
        ];

        $pdf = Pdf::loadView('pdf.surat_pemutihan', $data)->setPaper('A4', 'portrait');
        return $pdf->stream('surat_pemutihan_'.$kendaraan->nomor_polisi.'.pdf');
    }


    /* ============================================================
     *  CETAK PDF SPBKB
     * ============================================================ */
    public function cetakSpbkb(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'sekretaris' => 'required'
        ]);

        $data = [
            'kendaraan' => $kendaraan->load('pegawai'),
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'sekretaris' => $request->sekretaris
        ];

        $pdf = Pdf::loadView('pdf.spbkb', $data)->setPaper('A4', 'portrait');
        return $pdf->stream('spbkb_'.$kendaraan->nomor_polisi.'.pdf');
    }
}
