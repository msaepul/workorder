<?php

namespace App\Http\Controllers;

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
        $WoCount = workorder::query()
        ->where('cabang_id', '=', getUserCabang())
        ->count();
    
    $WoDoneCount = workorder::query()
        ->where('status', '=', 5)
        ->where('cabang_id', '=', getUserCabang())
        ->count();
    
    $UserCount = User::query()
        ->where('cabang','=',getUserCabang())
        ->count();

        $PurchaseCount = tambahstok::query()
        ->where('id_cabang','=',getUserCabang())
        ->count();
    
    return view('Admin.dashboard', compact('WoCount', 'UserCount', 'WoDoneCount','PurchaseCount'));
    
    }

    public function Gallery()
    {
        $UserCount = User::count();
        return view('Admin.gallery');
    }

    public function profile()
    {




        $id = Auth::user()->id;
        $hisparepart = keluarstok::join('tb_sparepart','tb_keluarstok.id_Spr','=','tb_sparepart.id')
        ->select('tb_keluarstok.*','tb_sparepart.nama_sparepart AS nama_sparepart')
        ->where('tb_keluarstok.user_id','=',$id)
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
        return view('Admin.profile', compact('user','perangkatcpu','perangkatmon','perangkatups','perangkatprt','hisparepart','id'));
    }
}
