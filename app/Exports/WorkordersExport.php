<?php

namespace App\Exports;

use App\Models\workorder;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class WorkordersExport implements FromCollection, WithHeadings
{

   
    public function collection()
    {
        return workorder::all();
    }
    public function headings(): array
    {
        return [
            'ID',
            'No WO',
            'WO Created',
            'Kategori WO',
            'Perangkat ID',
            'Lokasi',
            'Obyek',
            'Keadaan',
            'Status',
            'Lampiran',
            'User ID',
            'User Fix ID',
            'Cabang ID',
            'Created At',
            'Updated At',
            'Analisa',
            'Tindakan',
            'ID TX',
            'Date Start',
            'Date End',
            'Date Actual',
        ];
    }
}
