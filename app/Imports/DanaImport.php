<?php

namespace App\Imports;

use App\Models\Dana;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DanaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek apakah kolom ini mengandung no_va dengan awalan 988
        if (!preg_match('/(988\d{10,})/', $row['no_va'], $matches)) {
            return null; // skip baris yang tidak ada VA diawali 988
        }

        $clean_va = $matches[1];

        // Pastikan nominal angka saja
        $nominal = preg_replace('/[^\d]/', '', $row['nominal']);
        $nominal = $nominal ? (float) $nominal : 0;

        return new Dana([
            'no_va'   => $clean_va,
            'tipe'    => strtoupper(trim($row['tipe'] ?? '')),
            'nominal' => $nominal,
            'status'  => 'Belum Dikembalikan',
        ]);
    }
}