<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\perangkat;
use App\Models\workorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkorderController extends Controller
{

    public function index()
    {
    }
    public function create()
    {
        $id = Auth::user()->id;
        $listperangkat = perangkat::where('user_id', $id)->get();

        $currentMonth = date('m');
        $currentYear = date('Y');
        $no =  'WO'.'-'.cabang().'/'. $currentYear  .'/'. tgl_id($currentMonth) .'/'. '...';
        return view('Workorder.create', compact('currentYear', 'currentMonth', 'no','listperangkat','id'));
        
    }

    public function woproses(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama_' => 'required',
        ], [
            'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
        ]);

        $workorders = new workorder;
        $workorders->no_wo =workorder::generateNomor();
        $workorders->kategori_wo = $request->input('kategori_wo');
        $workorders->perangkat_id = $request->input('perangkat_id');
        

        // Simpan work$workorders ke database
        $workorders->save();


        return redirect()->back();
      
      
    }
    public function datawo()
    {
        // $departemen = Departemen::all();
        // $cabang = Cabang::all();
        $workorders = workorder::all();
        $users = User::all()->first();
        return view('Workorder.datawo', compact( 'users','workorders'));
    }
}
