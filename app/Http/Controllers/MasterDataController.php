<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use App\Models\Departemen;
use App\Models\perangkat;
use App\Models\brand;
use App\Models\type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MasterDataController extends Controller
{
  public function user()
  {

    $departemen = Departemen::all();
    $cabang = Cabang::all();
    $users = User::with('cabang', 'departemen')->paginate(100);
    return view('Masterdata.user.user', compact('departemen', 'cabang', 'users'));
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

    $departemen = Departemen::all();
    $cabang = Cabang::all();
    $users = User::with('cabang', 'departemen')->paginate(100);
    return view('Masterdata.user.user', compact('departemen', 'cabang', 'users'));
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

    $perangkat = perangkat::with('type', 'brand','user.cabang')->get();
    // $perangkat = Perangkat::join('tb_brand', 'tb_perangkat.id_brand', '=', 'tb_brand.id')
    // ->join('tb_type', 'tb_perangkat.id_type', '=', 'tb_type.id')
    // ->select('tb_perangkat.*', 'tb_brand.name_brand AS brand_name', 'tb_type.name_type AS type_name')
    // ->get();
    return view('Masterdata.perangkat.perangkat', compact('perangkat'));
  }
  public function tambahperangkat()
  {
    
    return view('Masterdata.perangkat.addperangkat');
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
