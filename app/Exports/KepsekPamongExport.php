<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KepsekPamongExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    public function collection()
    {
        return DB::table('ampraham_ppl_tbl as ppl')
            ->join('sekolah_tbl as s_tbl', 'ppl.id_sekolah', '=', 's_tbl.id')
            ->selectRaw(
                'ROW_NUMBER() OVER (ORDER BY ppl.id) AS row_index,
                ppl.name,
                ppl.nip,
                ppl.jabatan,
                ppl.pangkat_dan_golongan,
                ppl.jabatan,
                s_tbl.name as sekolah_name,
                ppl.nama_bank,
                ppl.no_rekening,
                ppl.no_npwp'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIP',
            'Pangkat & Golongan',
            'Jabatan',
            'Nama Sekolah',
            'Nama Bank',
            'No. Rekening',
            'No. NPWP'
        ];
    }

    public function map($row): array
    {
        return [
            $row->row_index,
            $row->name,
            "'" . $row->nip, // Add single quote for text formatting
            $row->pangkat_dan_golongan,
            $row->jabatan,
            $row->sekolah_name,
            $row->nama_bank,
            "'" . $row->no_rekening, // Ensure no_rekening is treated as text
            "'" . $row->no_npwp, // Ensure no_npwp is treated as text
        ];
    }

    public function columnFormats(): array
    {
        // Dynamically apply text format to all columns
        $columns = range('A', 'Z'); // Extend if more columns are needed
        $formats = [];
        foreach ($columns as $column) {
            $formats[$column] = NumberFormat::FORMAT_TEXT;
        }
        return $formats;
    }
}
