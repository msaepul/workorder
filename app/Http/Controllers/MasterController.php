<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dept;
use App\Models\type;
use App\Models\User;
use App\Models\brand;
use App\Models\Jenis;
use App\Models\Cabang;
use App\Models\perangkat;
use App\Models\supplier;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;

class MasterController extends Controller
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
            ->join('tb_jenis', 'tb_perangkat.id_jenis', '=', 'tb_jenis.id')
            ->join('tb_type', 'tb_perangkat.id_type', '=', 'tb_type.id')
            ->join('tb_cabang', 'tb_perangkat.cabang_id', '=', 'tb_cabang.id')
            ->select('tb_perangkat.*', 'tb_brand.name_brand AS brand_name', 'tb_type.name_type AS type_name', 'tb_cabang.cabang AS cabang_name', 'tb_jenis.jenis_perangkat AS jenis_perangkat')
            ->get();
        return view('Masterdata.perangkat.perangkat', compact('perangkat'));
    }

    public function tambahperangkat()
    {
        $jeniss = Jenis::all();
        $depts = Dept::all();
        $brands = Brand::all();
        $suppliers = supplier::all();
        $types = Type::all();


        $cabang = session('cabang');

        // $users = User::all();
        $users = DB::table('tb_login')->where('cabang', $cabang)->get();
        return view('Masterdata.perangkat.addperangkat', compact('brands', 'types', 'depts', 'users', 'jeniss','suppliers'));
    }

    public function perangkatproses(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nama_perangkat' => 'required',
            'id_jenis' => 'required',
            'nama_brand' => 'required',
            'nama_type' => 'required',
            'spesifikasi' => 'required',
            'tgl_pbl' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            // tambahkan validasi untuk kolom lainnya
        ], [
            'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            'id_jenis.required' => 'Kolom Jenis Perangkat harus diisi.',
            'nama_brand.required' => 'Kolom Brand harus diisi.',
            'nama_type.required' => 'Kolom Type harus diisi.',
            'spesifikasi.required' => 'Kolom Spesifikasi harus diisi.',
            'tgl_pbl.required' => 'Kolom Tanggal Pembelian harus diisi.',
            'user_id.required' => 'Kolom Pengguna / Departemen harus diisi.',
            'status.required' => 'Kolom Status harus diisi.',
            // tambahkan pesan untuk aturan validasi lainnya
        ]);

        // Buat objek Device baru
        $perangkat = new perangkat;
        $perangkat->nama_perangkat = $request->input('nama_perangkat');
        $perangkat->id_jenis = $request->input('id_jenis');
        $perangkat->id_brand = $request->input('nama_brand');
        $perangkat->id_type = $request->input('nama_type');
        $perangkat->spesifikasi = $request->input('spesifikasi');
        $perangkat->date_purchase = $request->input('tgl_pbl');
        $perangkat->user_id = $request->input('user_id');
        $perangkat->cabang_id = $request->input('cabang_id');
        $perangkat->id_teamviewer = $request->input('id_teamviewer');
        $perangkat->id_anydesk = $request->input('id_anydesk');
        $perangkat->ip = $request->input('ip');
        $perangkat->mac_address = $request->input('macaddress');
        $perangkat->status = $request->input('status');
        $perangkat->nopo = $request->input('nopo');
        $perangkat->supplier = $request->input('supplier');
        $perangkat->harga = $request->input('harga');
        // set kolom lainnya

        // Simpan perangkat ke database
        $perangkat->save();

        return redirect()->route('perangkat')->with('success', 'Perangkat berhasil ditambahkan.');
    }

    //edit perangkat
    public function editperangkat($id)
    {

        $jeniss = Jenis::all();
        $depts = Dept::all();
        $brands = Brand::all();
        $types = Type::all();
        $cabang = session('cabang');
        $users = DB::table('tb_login')->where('cabang', $cabang)->get();


        // Mengambil data berdasarkan ID
        $data = perangkat::findOrFail($id);


        // Menampilkan form edit dengan data yang sudah ada
        return view('masterdata.perangkat.editperangkat', compact('users', 'jeniss', 'depts', 'brands', 'types', 'data'));
    }

    public function updateperangkat(Request $request, $id)
    {

        // Validasi inputan
        $validatedData = $request->validate([
            'nama_perangkat' => 'required',
            'id_jenis' => 'required',
            'nama_brand' => 'required',
            'nama_type' => 'required',
            'spesifikasi' => 'required',
            'tgl_pbl' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            // tambahkan validasi untuk kolom lainnya
        ], [
            'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            'id_jenis.required' => 'Kolom Jenis Perangkat harus diisi.',
            'nama_brand.required' => 'Kolom Brand harus diisi.',
            'nama_type.required' => 'Kolom Type harus diisi.',
            'spesifikasi.required' => 'Kolom Spesifikasi harus diisi.',
            'tgl_pbl.required' => 'Kolom Tanggal Pembelian harus diisi.',
            'user_id.required' => 'Kolom Pengguna / Departemen harus diisi.',
            'status.required' => 'Kolom Status harus diisi.',
            // tambahkan pesan untuk aturan validasi lainnya
        ]);


        // Perbarui data yang ada di basis data
        $data = perangkat::findOrFail($id);

        $data->nama_perangkat = $request->nama_perangkat;
        $data->id_jenis = $request->id_jenis;
        $data->id_brand = $request->nama_brand;
        $data->id_type = $request->nama_type;
        $data->spesifikasi = $request->spesifikasi;
        $data->date_purchase = $request->tgl_pbl;
        $data->user_id = $request->user_id;
        $data->cabang_id = $request->cabang_id;
        $data->id_teamviewer = $request->id_teamviewer;
        $data->id_anydesk = $request->id_anydesk;
        $data->ip = $request->ip;
        $data->mac_address = $request->macaddress;
        $data->status = $request->status;
        $data->nopo = $request->nopo;
        $data->supplier = $request->supplier;
        $data->harga = $request->harga;
        // set kolom lainnya

        // tambahkan atribut lainnya sesuai kebutuhan
        $data->save();




        // Redirect ke halaman sukses atau halaman lain yang diinginkan
        return redirect()->route('perangkat')->with('success', 'Perangkat berhasil diperbarui.');
    }

    public function hapusperangkat($id)
    {
        $data = Perangkat::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return redirect()->route('perangkat')->with('success', 'Data berhasil dihapus');
    }



    public function brandproses(Request $request)
    {
        $validatedData = $request->validate([
            'nama_brand' => 'required',
        ], [
            'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
        ]);

        $brand = new brand;
        $brand->name_brand = $request->input('nama_brand');
        $brand->ket_brand = $request->input('ket_brand');

        // Simpan brand ke database
        $brand->save();


        return redirect()->back();
    }

    public function typeproses(Request $request)
    {
        $validatedData = $request->validate([
            'nama_type' => 'required',
        ], [
            'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
        ]);

        $type = new type;
        $type->id_jenis = $request->input('id_jenis');
        $type->name_type = $request->input('nama_type');
        $type->ket_type = $request->input('ket_type');

        // Simpan type ke database
        $type->save();


        return redirect()->back();
    }


    public function supplierproses(Request $request)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required',
        ], [
            'nama_supplier.required' => 'Kolom Nama supplier harus diisi.',
        ]);

        $supplier = new supplier;
        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->alamat = $request->input('alamat');

        // Simpan supplier ke database
        $supplier->save();


        return redirect()->back();
    }
    // public function getTypeByJenis(Request $request)
    // {
    //     // Mendapatkan jenis perangkat yang dipilih dari permintaan AJAX
    //     $selectedJenisId = $request->input('selectedJenisId');

    //     // Query database untuk mendapatkan daftar type perangkat berdasarkan jenis perangkat
    //     $types = Type::where('id_jenis', $selectedJenisId)->get();

    //     // Mengembalikan data type perangkat dalam format JSON
    //     return response()->json($types);
    // }

    // public function cobatambahperangkat(Request $request)
    // {


    //   $jeniss = Jenis::all();
    //   $depts = Dept::all();
    //   $brands = Brand::all();
    //   $types = Type::all();


    //   $cabang =session('cabang');

    //   // $users = User::all();
    //   $users = DB::table('tb_login')->where('cabang', $cabang)->get();
    //   return view('Masterdata.perangkat.cobaaddperangkat' , compact('brands','types','depts','users','jeniss'));
    // }



}
