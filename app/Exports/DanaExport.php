<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DanaExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $pdfVAs;

    /**
     * @param Collection $data Data dari database (Excel)
     * @param array|null $pdfVAs No. VA dari PDF (opsional, untuk validasi)
     */
    public function __construct(Collection $data = null, array $pdfVAs = null)
    {
        $this->data = $data ?? \App\Models\Dana::select('no_va', 'tipe', 'nominal')->get();
        $this->pdfVAs = $pdfVAs ?? []; // No. VA dari PDF
    }

    public function collection()
    {
        $grouped = $this->data->groupBy('no_va');
        $results = collect();
        $rowNumber = 1;

        foreach ($grouped as $no_va => $records) {
            $credits = $records->where('tipe', 'C')->pluck('nominal')->toArray();
            $debits = $records->where('tipe', 'D')->pluck('nominal')->toArray();

            // Salin array untuk logika pairing
            $remainingDebits = $debits;

            $status = 'Belum Dikembalikan';

            foreach ($credits as $credit) {
                $key = array_search($credit, $remainingDebits);
                if ($key !== false) {
                    unset($remainingDebits[$key]); // Pasangan D ditemukan, hapus satu
                } else {
                    $status = 'Belum Dikembalikan';
                    break;
                }
            }

            // Jika semua C terpasangkan dengan D
            if (count($remainingDebits) === count($debits) - count($credits)) {
                $status = 'Sudah Dikembalikan';
            }

            // Cek validasi PDF
            $validasi = '';
            if (in_array($no_va, $this->pdfVAs)) {
                $validasi = $status === 'Sudah Dikembalikan' ? 'Tidak Valid' : 'Siap Dikembalikan';
            }

            $results->push([
                'no'         => $rowNumber++,
                'no_va'      => $no_va,
                'status'     => $status,
                'validasi'   => $validasi,
            ]);
        }

        return $results;
    }

    public function headings(): array
    {
        return ['No', 'No. VA', 'Status', 'Validasi PDF'];
    }
}
