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
      
            'tgl_dibuat'=>'required',
            'obyek'=> 'required',
            'keadaan'=> 'required',
            'user_id'=>'required'      
        ], [
            'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            'obyek.required' => 'Kolom Obyek Perangkat harus diisi.',
            'keadaan.required' => 'Kolom Keadaan Perangkat harus diisi.',
 
        ]);
$cabang = Auth::user()->cabang;

if ($request->hasFile('gambar')) {
    $file = $request->file('gambar');
    
    $currentMonth = date('m');
    $currentYear = date('Y');
    $tujuan_upload = 'Lampiran/Wo/'.cabang().'/'.$currentYear.'/'.$currentMonth;
    $generate = workorder::generateNomor();
    $nama_file = "{$generate}.{$file->getClientOriginalExtension()}";
    $file->move($tujuan_upload, $nama_file);

    $workorder = new workorder;
    $workorder->no_wo = $generate;
    $workorder->kategori_wo = $request->input('kategori_wo');
    $workorder->perangkat_id = $request->input('perangkat_id');
    $workorder->wo_create = $request->input('tgl_dibuat');
    $workorder->keadaan = $request->input('keadaan');
    $workorder->obyek = $request->input('obyek');
    $workorder->user_id = $request->input('user_id');
    $workorder->status = 1;
    $workorder->cabang_id = $cabang;
    $workorder->lampiran = $nama_file;

    // Simpan $workorder ke database
    $workorder->save();

    return redirect()->back();
} else {
    $errorMessage = 'Tidak ada file yang diunggah';
    return redirect()->back()->with('errorMessage', $errorMessage);
}

      
      
    }
    public function datawo()
    {
        // $departemen = Departemen::all();
        $cabang = Auth::user()->cabang;
        $workorders = workorder::where('cabang_id','=',$cabang)->get();
        $users = User::all()->first();
        return view('Workorder.datawo', compact( 'users','workorders'));
    }
}
