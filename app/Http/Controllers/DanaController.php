<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Smalot\PdfParser\Parser;
use App\Exports\DanaExport;
use App\Imports\DanaImport;

class DanaController extends Controller
{
    public function index(Request $request)
{
    $total_va = Dana::distinct('no_va')->count('no_va');
    $total_sudah = Dana::where('status', 'Sudah Dikembalikan')->count();
    $total_belum = Dana::where('status', 'Belum Dikembalikan')->count();

    $query = Dana::query();

    if ($request->filled('search')) {
        $query->where('no_va', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $data = $query->orderBy('created_at', 'desc')->paginate(20);

    return view('index', compact('data', 'total_va', 'total_sudah', 'total_belum'));
}

public function uploadExcel(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    try {
        Excel::import(new DanaImport, $request->file('file'));
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
    }

    // Ambil semua VA unik setelah import
    $noVAs = Dana::select('no_va')->distinct()->pluck('no_va');

    foreach ($noVAs as $no_va) {
        if (!$no_va) continue; // skip kalau null

        $total_c = Dana::where('no_va', $no_va)->where('tipe', 'C')->sum('nominal');
        $total_d = Dana::where('no_va', $no_va)->where('tipe', 'D')->sum('nominal');

        // Tentukan status
        if ($total_c > 0 && $total_c == $total_d) {
            $status = 'Sudah Dikembalikan';
        } elseif ($total_d == 0) {
            $status = 'Belum Dikembalikan';
        } elseif ($total_d < $total_c) {
            $status = 'Sebagian Dikembalikan';
        } elseif ($total_d > $total_c) {
            $status = 'Lebih Bayar';
        } else {
            $status = 'Belum Dikembalikan';
        }

        // Update semua baris dengan VA ini
        Dana::where('no_va', $no_va)->update(['status' => $status]);
    }

    return redirect()->back()->with('success', 'Data berhasil diunggah dan status diperbarui.');
}





    public function uploadPdf(Request $request)
    {
        $file = $request->file('pdf');
        $parser = new Parser();
        $pdf = $parser->parseFile($file);
        $text = $pdf->getText();

        $lines = explode("\n", $text);
        $results = [];

        foreach ($lines as $line) {
            if (preg_match('/(\d{10,})/', $line, $matches)) {
                $no_va = $matches[1];
                $nama = trim(str_replace($no_va, '', $line));
                $nama = preg_replace('/\|.*/', '', $nama); // buang setelah '|'

                $data_excel = Dana::where('no_va', $no_va)->first();
                $status = $data_excel ? 'Siap Dikembalikan' : 'Tidak Valid';

                $results[] = [
                    'no_va' => $no_va,
                    'nama' => $nama,
                    'status' => $status,
                ];
            }
        }

        return view('hasil_pdf', compact('results'));
    }

    public function reset()
    {
        Dana::truncate();
        return redirect()->route('index')->with('success', 'Semua data berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new DanaExport, 'data_pengembalian.xlsx');
    }

    public function exportFiltered(Request $request)
    {
        $query = Dana::query();

        if ($request->no_va) {
            $query->where('no_va', 'like', '%' . $request->no_va . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $filteredData = $query->get();

        return Excel::download(new DanaExport($filteredData), 'filtered_dana.xlsx');
    }
}
