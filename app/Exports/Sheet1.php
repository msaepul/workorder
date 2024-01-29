<?php

namespace App\Exports;

use DB;
use Throwable;
use App\Models\Modellpts;
use App\Models\workorder;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class Sheet1 implements FromView, WithEvents, WithTitle
{

    public function title(): string
    {
        $bulans = strtoupper(bln(@$_GET['bulan']));
        return "$bulans";
    }

    public function view(): View
    {
        $cabang = @$_GET['cabang'];
        $bulan = @$_GET['bulan'];
        $tahun = @$_GET['tahun'];
        $utamax = workorder::whereMonth('wo_create', '=', $bulan)
            ->whereYear('wo_create', '=', $tahun)
            ->where('cabang_id', '=', $cabang)
            // ->groupBy(DB::raw('MONTH(date_create)'))
            ->get();
        return view('workorder.report', compact('utamax', 'bulan', 'cabang'));
    }


    public function registerEvents(): array
    {
        return [];
    }
}
