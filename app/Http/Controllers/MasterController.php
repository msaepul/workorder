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
    // Master Data User
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
            'departemen_id' => 'required',
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

    // Master Data Perangkat
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
        $users = DB::table('tb_login')
            ->where('cabang', $cabang)
            ->get();
        return view('Masterdata.perangkat.addperangkat', compact('brands', 'types', 'depts', 'users', 'jeniss', 'suppliers'));
    }

    public function perangkatproses(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate(
            [
                'nama_perangkat' => 'required',
                'id_jenis' => 'required',
                'nama_brand' => 'required',
                'nama_type' => 'required',
                'spesifikasi' => 'required',
                'tgl_pbl' => 'required',
                'user_id' => 'required',
                'status' => 'required',
                // tambahkan validasi untuk kolom lainnya
            ],
            [
                'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
                'id_jenis.required' => 'Kolom Jenis Perangkat harus diisi.',
                'nama_brand.required' => 'Kolom Brand harus diisi.',
                'nama_type.required' => 'Kolom Type harus diisi.',
                'spesifikasi.required' => 'Kolom Spesifikasi harus diisi.',
                'tgl_pbl.required' => 'Kolom Tanggal Pembelian harus diisi.',
                'user_id.required' => 'Kolom Pengguna / Departemen harus diisi.',
                'status.required' => 'Kolom Status harus diisi.',
                // tambahkan pesan untuk aturan validasi lainnya
            ],
        );

        // Buat objek Device baru
        $perangkat = new perangkat();
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

        return redirect()
            ->route('perangkat')
            ->with('success', 'Perangkat berhasil ditambahkan.');
    }

    //edit perangkat
    public function editperangkat($id)
    {
        $jeniss = Jenis::all();
        $depts = Dept::all();
        $brands = Brand::all();
        $types = Type::all();
        $cabang = session('cabang');
        $users = DB::table('tb_login')
            ->where('cabang', $cabang)
            ->get();

        // Mengambil data berdasarkan ID
        $data = perangkat::findOrFail($id);

        // Menampilkan form edit dengan data yang sudah ada
        return view('masterdata.perangkat.editperangkat', compact('users', 'jeniss', 'depts', 'brands', 'types', 'data'));
    }

    public function updateperangkat(Request $request, $id)
    {
        // Validasi inputan
        $validatedData = $request->validate(
            [
                'nama_perangkat' => 'required',
                'id_jenis' => 'required',
                'nama_brand' => 'required',
                'nama_type' => 'required',
                'spesifikasi' => 'required',
                'tgl_pbl' => 'required',
                'user_id' => 'required',
                'status' => 'required',
                // tambahkan validasi untuk kolom lainnya
            ],
            [
                'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
                'id_jenis.required' => 'Kolom Jenis Perangkat harus diisi.',
                'nama_brand.required' => 'Kolom Brand harus diisi.',
                'nama_type.required' => 'Kolom Type harus diisi.',
                'spesifikasi.required' => 'Kolom Spesifikasi harus diisi.',
                'tgl_pbl.required' => 'Kolom Tanggal Pembelian harus diisi.',
                'user_id.required' => 'Kolom Pengguna / Departemen harus diisi.',
                'status.required' => 'Kolom Status harus diisi.',
                // tambahkan pesan untuk aturan validasi lainnya
            ],
        );

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
        return redirect()
            ->route('perangkat')
            ->with('success', 'Perangkat berhasil diperbarui.');
    }

    public function hapusperangkat($id)
    {
        $data = Perangkat::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return redirect()
            ->route('perangkat')
            ->with('success', 'Data berhasil dihapus');
    }

    // Master Data Brand

    public function masterbrand()
    {
        // $perangkat = perangkat::with('type', 'brand','user.cabang')->get();
        $brand = brand::all();
        return view('Masterdata.brand.masterBrand', compact('brand'));
    }
    public function brandproses(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_brand' => 'required',
            ],
            [
                'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            ],
        );

        $brand = new brand();
        $brand->name_brand = $request->input('nama_brand');
        $brand->ket_brand = $request->input('ket_brand');

        // Simpan brand ke database
        $brand->save();

        return redirect()->back();
    }

    public function hapusbrand($id)
    {
        $data = brand::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function mastereditbrand(Request $request, $id)
    {
            // Validate the request data as needed
            $validatedData = $request->validate([
                'name_brand' => 'required|string|max:255',
                'ket_brand' => 'nullable|string',
                // Add other validation rules as needed
            ]);

            $brand = brand::findOrFail($id);

            // Update the brand with the validated data
            $brand->update($validatedData);

            // Redirect to the brand list or wherever you need to go after the update
            return redirect()
                ->route('masterbrand')
                ->with('success', 'Data brand Berhasil di Update');
    }



    // Master Data Supplier
    public function supplierproses(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_supplier' => 'required',
            ],
            [
                'nama_supplier.required' => 'Kolom Nama supplier harus diisi.',
            ],
        );

        $supplier = new supplier();
        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->alamat = $request->input('alamat');

        // Simpan supplier ke database
        $supplier->save();

        return redirect()->back();
    }

    // Master Data Cabang

    public function mastercabang()
    {
        // $perangkat = perangkat::with('type', 'cabang','user.cabang')->get();
        $cabang = cabang::all();
        return view('Masterdata.cabang.mastercabang', compact('cabang'));
    }
    public function cabangproses(Request $request)
    {
        $validatedData = $request->validate(
            [
                'cabang ' => 'required',
            ],
            [
                'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            ],
        );

        $cabang = new Cabang();
        $cabang->cabang = $request->input('cabang');
        $cabang->ket = $request->input('ket');

        // Simpan cabang ke database
        $cabang->save();

        return redirect()->back();
    }

    public function hapuscabang($id)
    {
        $data = cabang::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function mastereditcabang(Request $request, $id)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'cabang' => 'required|string|max:255',
            'ket' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        $cabang = cabang::findOrFail($id);

        // Update the cabang with the validated data
        $cabang->update($validatedData);

        // Redirect to the cabang list or wherever you need to go after the update
        return redirect()
            ->route('mastercabang')
            ->with('success', 'Data cabang Berhasil di Update');
    }

    // Master Data departemen

    public function masterdepartemen()
    {
        // $perangkat = perangkat::with('type', 'departemen','user.departemen')->get();
        $departemen = dept::all();
        return view('Masterdata.departemen.masterdepartemen', compact('departemen'));
    }
    public function departemenproses(Request $request)
    {
        $validatedData = $request->validate(
            [
                'dept' => 'required',
            ],
            [
                'dept' => 'Kolom Nama Perangkat harus diisi.',
            ],
        );

        $dept = new dept();
        $dept->dept = $request->input('dept');
        $dept->ket = $request->input('ket');

        // Simpan dept ke database
        $dept->save();

        return redirect()->back();
    }

    public function hapusdepartemen($id)
    {
        $data = dept::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return back()->with('success', 'Data berhasil dihapus');
    }
    public function mastereditdepartemen(Request $request, $id)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'departemen' => 'required|string|max:255',
            'ket' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        $departemen = dept::findOrFail($id);

        // Update the departemen with the validated data
        $departemen->update($validatedData);

        // Redirect to the departemen list or wherever you need to go after the update
        return redirect()
            ->route('masterdepartemen')
            ->with('success', 'Data departemen Berhasil di Update');
    }


     // Master Data jenis

    public function masterjenis()
    {
        // $perangkat = perangkat::with('type', 'jenis','user.cabang')->get();
        $jenis = jenis::all();
        return view('Masterdata.jenis.masterjenis', compact('jenis'));
    }
    public function jenisproses(Request $request)
    {
        $validatedData = $request->validate(
            [
                'jenis_perangkat' => 'required',
            ],
            [
                'jenis_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            ],
        );

        $jenis = new jenis();
        $jenis->jenis_perangkat = $request->input('jenis_perangkat');

        // Simpan jenis ke database
        $jenis->save();

        return redirect()->back();
    }

    public function hapusjenis($id)
    {
        $data = jenis::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function mastereditjenis(Request $request, $id)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'jenis_perangkat' => 'required|string|max:255'
        ]);

        $jenis = jenis::findOrFail($id);

        // Update the jenis with the validated data
        $jenis->update($validatedData);

        // Redirect to the jenis list or wherever you need to go after the update
        return redirect()
            ->route('masterjenis')
            ->with('success', 'Data jenis Berhasil di Update');
    }

    // Master Data Type Perangkat

    public function mastertype()
        {
            // $perangkat = perangkat::with('type', 'type','user.cabang')->get();
            $type = type::all();
            $jeniss = Jenis::all();
            return view('Masterdata.type.mastertype', compact('type','jeniss',));
        }

      //Master Data Type  Proses
    public function typeproses(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_type' => 'required',
            ],
            [
                'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            ],
        );

        $type = new type();
        $type->id_jenis = $request->input('id_jenis');
        $type->name_type = $request->input('nama_type');
        $type->ket_type = $request->input('ket_type');

        // Simpan type ke database
        $type->save();

        return redirect()->back();
    }

    public function hapustype($id)
    {
        $data = type::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return back()->with('success', 'Data berhasil dihapus');
    }
    
    public function masteredittype(Request $request, $id)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'nama_type' => 'required|string|max:255',
            'id_jenis' => 'required',       
        ]);

        $type = type::findOrFail($id);

        // Update the type with the validated data
        $type->update($validatedData);

        // Redirect to the type list or wherever you need to go after the update
        return redirect()
            ->route('mastertype')
            ->with('success', 'Data type Berhasil di Update');
    }
}
