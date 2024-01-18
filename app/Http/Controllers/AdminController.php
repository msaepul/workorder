<?php

namespace App\Http\Controllers;

use Charts;
use Carbon\Carbon;
use App\Models\User;
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
            $items = keluarstok::get();
        } else {
            $Wo = workorder::where('cabang_id', '=', getUserCabang())->get();
            $items = keluarstok::where('cabang_id', '=', getUserCabang())->get();
        }


        foreach ($Wo as $d) {
            $d->formatted_date_start = Carbon::parse($d->date_start)->format('Y, n - 1, j, G, i');
            $d->formatted_date_end = $d->date_end !== null ? Carbon::parse($d->date_end)->format('Y, n - 1, j, G, i') : false;
        }


        $purchase = tambahstok::where('id_cabang', '=', getUserCabang())->get();


        // Menggabungkan dua koleksi
        $activities = $purchase->merge($items);

        // Menyortir aktivitas berdasarkan waktu (contoh: created_at)
        $activities = $activities->sortByDesc('created_at');



        $WoCount = workorder::where('cabang_id', '=', getUserCabang())->count();
        $WoDoneCount = workorder::where('status', '=', 5)->where('cabang_id', '=', getUserCabang())->count();
        $UserCount = User::where('cabang', '=', getUserCabang())->count();


        // $chart = Charts::create('bar', 'chartjs')
        //     ->title('Contoh Grafik')
        //     ->labels(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'])
        //     ->values([50, 80, 30, 60, 20, 75]);

        return view('Admin.dashboard', compact('WoCount', 'UserCount', 'WoDoneCount', 'purchase', 'Wo', 'items', 'activities'));
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
        $user = user::all();
        return view('Admin.profile', compact('user', 'perangkatcpu', 'perangkatmon', 'perangkatups', 'perangkatprt', 'hisparepart', 'id'));
    }
}
