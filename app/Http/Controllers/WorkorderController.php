<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
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
        $kodeMax =
            [
                'kodeMax' => workorder::all()
                    ->max('no_wo')
            ];
            
        $data = [
            'todayDate' => Carbon::now(),
            'user' => Auth::user()
        ];
        return view('Workorder.create', $data, $kodeMax);
    }

    public function woproses(Request $request)
    {
      $request->validate([
           'no_wo' => 'required',
            'wo_create' => 'required',
            'kategori_wo' => 'required',
            'jenis_perangkat' => '',
            'lokasi' => 'required',
            'obyek' => 'required',
            'keadaan' => 'required',
            'user_id' => 'required',

      ]);
        workorder::create($request->all());
      
      
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
