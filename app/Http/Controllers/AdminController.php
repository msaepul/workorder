<?php

namespace App\Http\Controllers;

use Charts;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cabang;
use App\Models\perangkat;
use App\Models\workorder;
use App\Models\keluarstok;
use App\Models\tambahstok;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (getUserDept() == "EDP" &&  getUserCabang() == 100) {
            $Wo = workorder::all();
            $WoCount = workorder::where('cabang_id', '=', getUserCabang())->count();
            $WoDoneCount = workorder::where('status', '=', 5)->where('cabang_id', '=', getUserCabang())->count();
            $items = keluarstok::get();
        } elseif ((getUserDept() == "EDP" &&  getUserCabang() != 100)) {
            $Wo = workorder::where('cabang_id', '=', getUserCabang())->get();

            $WoCount = workorder::where('cabang_id', '=', getUserCabang())->count();
            $WoDoneCount = workorder::where('status', '=', 5)->where('cabang_id', '=', getUserCabang())->count();
            $items = keluarstok::where('cabang_id', '=', getUserCabang())->get();
        } else {

            $WoCount = workorder::where('cabang_id', '=', getUserCabang())->where('user_id', '=', getUserId())->count();
            $WoDoneCount = workorder::where('status', '=', 5)->where('cabang_id', '=', getUserCabang())->where('user_id', '=', getUserId())->count();
            $Wo = workorder::where('cabang_id', '=', getUserCabang())->where('user_id', '=', getUserId())->get();
            $items = keluarstok::where('cabang_id', '=', getUserCabang())->where('user_id', '=', getUserId())->get();
        }
        foreach ($Wo as $d) {
            $d->formatted_date_start = Carbon::parse($d->date_start)->format('Y, n - 1, j, G, i');
            $d->formatted_date_end = $d->date_end !== null ? Carbon::parse($d->date_end)->format('Y, n - 1, j, G, i') : false;
        }


        $purchase = tambahstok::where('id_cabang', '=', getUserCabang())->get();
        $activities = $purchase->merge($items);
        $activities = $activities->sortByDesc('created_at');

        $wocountbydevice = workorder::where('cabang_id', '=', getUserCabang())
            ->whereNotNull('perangkat_id') // Hanya ambil work order dengan perangkat_id tidak null
            ->select('perangkat_id', DB::raw('COUNT(*) as total'))
            ->groupBy('perangkat_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();




        $UserCount = User::where('cabang', '=', getUserCabang())->count();
        $Devicecount = perangkat::where('user_id', '=', getUserId())->count();


        $datasparepart = [
            'pembelian' => tambahstok::where('id_cabang', getUserCabang())->sum(\DB::raw('qty * harga')),
            'pengeluaran' => keluarstok::where('cabang_id', getUserCabang())->sum(\DB::raw('qty * harga')),
        ];
        $dataworkorder = [
            'draft' => workorder::where('cabang_id', getUserCabang())->where('status', '=', '1')->count(),
            'confirm' => workorder::where('cabang_id', getUserCabang())->where('status', '=', '2')->count(),
            'Onproses' => workorder::where('cabang_id', getUserCabang())->where('status', '=', '3')->count(),
            'validasi' => workorder::where('cabang_id', getUserCabang())->where('status', '=', '4')->count(),
            'selesai' => workorder::where('cabang_id', getUserCabang())->where('status', '=', '5')->count(),
        ];
        $datacabang = [
            'pdl'   =>  workorder::where('cabang_id', '101')->where('status', '!=', '7')->count(),
            'tgl'   =>  workorder::where('cabang_id', '102')->where('status', '!=', '7')->count(),
            'mdo'   =>  workorder::where('cabang_id', '103')->where('status', '!=', '7')->count(),
            'mks'   =>  workorder::where('cabang_id', '104')->where('status', '!=', '7')->count(),
            'kdr'   =>  workorder::where('cabang_id', '105')->where('status', '!=', '7')->count(),
            'bdj'   =>  workorder::where('cabang_id', '106')->where('status', '!=', '7')->count(),
            'bwi'   =>  workorder::where('cabang_id', '107')->where('status', '!=', '7')->count(),
            'lpg'   =>  workorder::where('cabang_id', '108')->where('status', '!=', '7')->count(),
            'dmk'   =>  workorder::where('cabang_id', '109')->where('status', '!=', '7')->count(),
            'plm'   =>  workorder::where('cabang_id', '110')->where('status', '!=', '7')->count(),
            'bli'   =>  workorder::where('cabang_id', '111')->where('status', '!=', '7')->count(),
            'pku'   =>  workorder::where('cabang_id', '112')->where('status', '!=', '7')->count(),
            'mdn'   =>  workorder::where('cabang_id', '116')->where('status', '!=', '7')->count(),
            'lom'   =>  workorder::where('cabang_id', '117')->where('status', '!=', '7')->count(),
            'pnk'   =>  workorder::where('cabang_id', '118')->where('status', '!=', '7')->count(),
            'llg'   =>  workorder::where('cabang_id', '119')->where('status', '!=', '7')->count(),
            'cbl'   =>  workorder::where('cabang_id', '121')->where('status', '!=', '7')->count(),
            'jtw'   =>  workorder::where('cabang_id', '122')->where('status', '!=', '7')->count(),
            'plu'   =>  workorder::where('cabang_id', '123')->where('status', '!=', '7')->count(),
            'amq'   =>  workorder::where('cabang_id', '124')->where('status', '!=', '7')->count(),
            'kdi'   =>  workorder::where('cabang_id', '125')->where('status', '!=', '7')->count(),
        ];
        $datawodept = [
            'mkt' => workorder::where('dept', 'MKT')->where('cabang_id', getUserCabang())->count(),
            'prc' => workorder::where('dept', 'PRC')->where('cabang_id', getUserCabang())->count(),
            'pbl' => workorder::where('dept', 'PBL')->where('cabang_id', getUserCabang())->count(),
            'gbb' => workorder::where('dept', 'GBB')->where('cabang_id', getUserCabang())->count(),
            'pro' => workorder::where('dept', 'PRO')->where('cabang_id', getUserCabang())->count(),
            'eng' => workorder::where('dept', 'ENG')->where('cabang_id', getUserCabang())->count(),
            'qct' => workorder::where('dept', 'QCT')->where('cabang_id', getUserCabang())->count(),
            'gpj' => workorder::where('dept', 'GPJ')->where('cabang_id', getUserCabang())->count(),
            'eks' => workorder::where('dept', 'EKS')->where('cabang_id', getUserCabang())->count(),
            'knd' => workorder::where('dept', 'KND')->where('cabang_id', getUserCabang())->count(),
            'fin' => workorder::where('dept', 'FIN')->where('cabang_id', getUserCabang())->count(),
            'acc' => workorder::where('dept', 'ACC')->where('cabang_id', getUserCabang())->count(),
            'hrd' => workorder::where('dept', 'HRD')->where('cabang_id', getUserCabang())->count(),
            'sis' => workorder::where('dept', 'SIS')->where('cabang_id', getUserCabang())->count(),
            'edp' => workorder::where('dept', 'EDP')->where('cabang_id', getUserCabang())->count(),
            'tax' => workorder::where('dept', 'TAX')->where('cabang_id', getUserCabang())->count(),
            'grr' => workorder::where('dept', 'GRR')->where('cabang_id', getUserCabang())->count(),
            'gsp' => workorder::where('dept', 'GSP')->where('cabang_id', getUserCabang())->count(),
            'bm' => workorder::where('dept', 'BM')->where('cabang_id', getUserCabang())->count(),
        ];

        return view('Admin.dashboard', $datacabang, compact('WoCount', 'UserCount', 'WoDoneCount', 'purchase', 'Wo', 'items', 'activities', 'Devicecount', 'wocountbydevice'))->with($dataworkorder)->with($datasparepart)->with($datawodept);
    }

    public function Gallery()
    {
        $UserCount = User::count();
        return view('Admin.gallery');
    }

    public function calender()
    {
        // $UserCount = User::count();
        return view('Admin.calender');
    }

    public function profile()
    {

        $id = Auth::user()->id;
        $hisparepart = keluarstok::join('tb_sparepart', 'tb_keluarstok.id_Spr', '=', 'tb_sparepart.id')
            ->select('tb_keluarstok.*', 'tb_sparepart.nama_sparepart AS nama_sparepart')
            ->where('tb_keluarstok.user_id', '=', $id)
            ->get();

        $perangkatcpu = perangkat::where('user_id', $id)
            ->where('id_jenis', 13)
            ->get();

        $perangkatmon = perangkat::where('user_id', $id)
            ->where('id_jenis', 19)
            ->get();

        $perangkatups = perangkat::where('user_id', $id)
            ->where('id_jenis', 34)
            ->get();
        $perangkatprt = perangkat::where('user_id', $id)
            ->where('id_jenis', 23)
            ->get();

        $workorders = workorder::where('user_id', '=', getUserId())->get();

        $user = user::all();
        return view('Admin.profile', compact('user', 'perangkatcpu', 'perangkatmon', 'perangkatups', 'perangkatprt', 'hisparepart', 'id', 'workorders'));
    }
}
