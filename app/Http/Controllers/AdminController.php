<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\perangkat;
use App\Models\keluarstok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $UserCount = User::count();
        return view('Admin.dashboard', ['jumlah_user' => $UserCount]);
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
