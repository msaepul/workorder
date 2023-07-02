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
        $no =  'WO' . '-' . cabang() . '/' . $currentYear  . '/' . tgl_id($currentMonth) . '/' . '...';
        return view('Workorder.create', compact('currentYear', 'currentMonth', 'no', 'listperangkat', 'id'));
    }
    public function datawo()
    {
        // $departemen = Departemen::all();
        $cabang = Auth::user()->cabang;
        $user = Auth::user()->id;



        $workorders = workorder::where('cabang_id', '=', $cabang)->get();

        $workorder = workorder::where('user_id', '=', $user)->get();


        $users = User::all()->first();
        return view('Workorder.datawo', compact('users', 'workorders', 'workorder'));
    }
    public function woproses(Request $request)
    {

        $validatedData = $request->validate([

            'tgl_dibuat' => 'required',
            'obyek' => 'required',
            'keadaan' => 'required',
            'user_id' => 'required'
        ], [
            'nama_perangkat.required' => 'Kolom Nama Perangkat harus diisi.',
            'obyek.required' => 'Kolom Obyek Perangkat harus diisi.',
            'keadaan.required' => 'Kolom Keadaan Perangkat harus diisi.',

        ]);
        $cabang = Auth::user()->cabang;
        $generate = workorder::generateNomor();
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
           
            $currentMonth = date('m');
            $currentYear = date('Y');
            $tujuan_upload = 'Lampiran/Wo/' . cabang() . '/' . $currentYear . '/' . $currentMonth;
            $nama_file = "{$generate}.{$file->getClientOriginalExtension()}";
            $file->move($tujuan_upload, $nama_file);
            $lampiran = $nama_file;
        } else {
            $lampiran = null;
        }
        
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
        $workorder->lampiran = $lampiran;
        
        // Simpan $workorder ke database
        $workorder->save();
        
        $idwo = workorder::where('no_wo', $generate)->max('id');
        return redirect()->route('Workorder_detail', $idwo);
        
    }

    public function confirm()
    {
    }

    public function detailwo($id)
    {

        // Mengambil data berdasarkan ID
        $workorders = workorder::findOrFail($id);

        $no_wo = $workorders->lampiran;

        if ($no_wo !== null) {
            // Pisahkan string berdasarkan delimiter '/'
            $parts = explode('/', $no_wo);

            // Ambil bagian-bagian yang diperlukan
            $cabang = cabang();
            $tahun = $parts[1];
            $bulan = strtoupper(substr($parts[2], 0, 2));
            $nomor = $parts[3];

            // Gabungkan bagian-bagian menjadi string yang diinginkan
            $lampiran = 'Lampiran/Wo/' . $cabang . '/' . $tahun . '/' . bulan_angka($bulan) . '/' . $nomor;
        } else {
            $lampiran = "null";
        }

        return view('Workorder.detail', compact('workorders', 'lampiran'));
    }

    public function editwo($id)
    {
        
        // Mengambil data berdasarkan ID
        $workorders = workorder::findOrFail($id);
        $listperangkat = perangkat::where('user_id', $id)->get();

        $no_wo = $workorders->lampiran;

        if ($no_wo !== null) {
            // Pisahkan string berdasarkan delimiter '/'
            $parts = explode('/', $no_wo);

            // Ambil bagian-bagian yang diperlukan
            $cabang = cabang();
            $tahun = $parts[1];
            $bulan = strtoupper(substr($parts[2], 0, 2));
            $nomor = $parts[3];

            // Gabungkan bagian-bagian menjadi string yang diinginkan
            $lampiran = 'Lampiran/Wo/' . $cabang . '/' . $tahun . '/' . bulan_angka($bulan) . '/' . $nomor;
        } else {
            $lampiran = "null";
        }

        return view('Workorder.edit', compact('workorders', 'lampiran','listperangkat'));
    }
    public function editwoproses($id)
    {
        
        
    }

    public function updateStatus(Request $request, $id)
    {


        $status = $request->input('status');
        // Lakukan pembaruan status sesuai dengan nilai yang dikirimkan
        $data = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan data yang sesuai

        // Lakukan pembaruan status sesuai dengan nilai yang dikirimkan
        if ($status == 2) {
            // Lakukan aksi untuk status = 1
            $item = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
            $item->status = 2;
            $item->save();
        } elseif ($status == 0) {
            // Lakukan aksi untuk status = 0
            $item = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
            $item->status = 0;
            $item->save();
        } elseif ($status == 3) {
            // Lakukan aksi untuk status = 0
            $item = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
            $item->status = 3;
            $item->save();
        }
        $data->save();



        // Kembalikan respon atau lakukan pengalihan (redirect) ke halaman yang sesuai
        return redirect()->route('Workorder_detail', $id);
    }
}
