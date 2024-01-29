<?php

namespace App\Exports;

use App\Models\workorder;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class WorkordersExport implements WithMultipleSheets
{


    public function sheets(): array
    {
        return [
            new Sheet1(),
        ];
    }
}
