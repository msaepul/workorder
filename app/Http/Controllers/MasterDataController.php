<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use App\Models\Departemen;
use App\Models\perangkat;
use App\Models\brand;
use App\Models\type;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MasterDataController extends Controller
{
  public function user()
  {
    
    $users = DB::table('tb_login')
    ->join('tb_cabang', 'tb_login.cabang', '=', 'tb_cabang.id')
    ->select('tb_login.*', 'tb_cabang.ket', 'tb_cabang.cabang')
    ->get();

    // $users = User::with('cabang')->get();
    return view('Masterdata.user.user', compact('users'));
  }
  public function userProses(Request $request)
  {
    $validated = $request->validate([
      'nama_lengkap' => 'required|max:100',
      'username' => 'required|email|max:255|unique:users',
      'password' => 'required|max:255',
      'cabang_id' => 'required',
      'departemen_id' => 'required'

    ]);

    $request['password'] = Hash::make($request->password);

    $user = User::create($request->all());


    $users = User::with('Cabang')->get();
    return view('Masterdata.user.user', compact('users'));
  }


  public function updateUser(Request $request, $id)
  {
    $user = User::find($id);
    $input = $request->all();
    $user->fill($input)->save();

    return redirect('user');
  }
  public function deleteUser($id)
  {
    $user = User::find($id);
    $user->delete();

    return redirect('user');
  }

  public function hapusUser($id)
  {
    $user = User::find($id);
    $user->delete();
  }



  public function perangkat()
  {

    // $perangkat = perangkat::with('type', 'brand','user.cabang')->get();
    $perangkat = Perangkat::join('tb_brand', 'tb_perangkat.id_brand', '=', 'tb_brand.id')
    ->join('tb_type', 'tb_perangkat.id_type', '=', 'tb_type.id')
    ->join('tb_cabang', 'tb_perangkat.cabang_id', '=', 'tb_cabang.id')
    ->select('tb_perangkat.*', 'tb_brand.name_brand AS brand_name', 'tb_type.name_type AS type_name', 'tb_cabang.cabang AS cabang_name')
    ->get();
    return view('Masterdata.perangkat.perangkat', compact('perangkat'));
  }
  
  public function tambahperangkat()
  {
  
    return view('Masterdata.perangkat.addperangkat');
  }

  public function perangkatproses(Request $request)
{
    // Validasi inputan
    $validatedData = $request->validate([
        'nama_perangkat' => 'required',
        'jenis_perangkat' => 'required',
        'nama_brand' => 'required',
        'nama_type' => 'required',
        'spesifikasi' => 'required',
        'tgl_pbl' => 'required',
        'dept' => 'required',
        'user_id' => 'required',
        'id_teamviewer' => 'required',
        'id_anydesk' => 'required',
        'ip' => 'required',
        'macaddress' => 'required',
        // tambahkan validasi untuk kolom lainnya
    ]);

    // Buat objek Device baru
    $device = new Device;
    $device->nama_perangkat = $request->input('nama_perangkat');
    $device->jenis_perangkat = $request->input('jenis_perangkat');
    $device->id_brand = $request->input('nama_brand');
    $device->id_type = $request->input('nama_type');
    $device->spesifikasi = $request->input('spesifikasi');
    $device->date_purchase = $request->input('tgl_pbl');
    $device->user_id = $request->input('user_id');
    $device->cabang_id = 101;
    $device->id_teamviewer = $request->input('id_teamviewer');
    $device->id_anydesk = $request->input('id_anydesk');
    $device->ip = $request->input('ip');
    $device->mac_address = $request->input('macaddress');
    // set kolom lainnya

    // Simpan perangkat ke database
    $device->save();

    return redirect()->route('perangkat')->with('success', 'Perangkat berhasil ditambahkan.');
}

  public function sparepart()
  {
    return view('Masterdata.sparepart.sparepart');
  }
  public function tambahsparepart()
  {
    
    return view('Masterdata.sparepart.addsparepart');
  }
}
