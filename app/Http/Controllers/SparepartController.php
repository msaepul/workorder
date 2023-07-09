<?php

namespace App\Http\Controllers;

use App\Models\keluarstok;
use App\Models\User;
use App\Models\supplier;
use App\Models\tambahstok;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartController extends Controller
{

    public function sparepart()

    {

        $sparepart = Sparepart::where('id_cabang', '=', getUserCabang())->get();
        $results = [];

        foreach ($sparepart as $part) {
            $result = $part->harga * $part->stok;
            $results[] = $result;
        }
        // $sparepart = 
        return view('Masterdata.sparepart.sparepart', compact('sparepart', 'results'));
    }


    //Sparepart in
    public function txsparepart()
    {
        $sparepart = Sparepart::where('id_cabang', '=', getUserCabang())->get();
        $suppliers = supplier::all();
        $cabang = session('cabang');
        return view('Masterdata.sparepart.addsparepart', compact('sparepart', 'suppliers', 'cabang'));
    }


    //transaksi sparepart
    public function txsprproses(Request $request)
    {

        $tgls = $request->input('tgl_pbl');
        $nopos = $request->input('nopo');
        $suppliers = $request->input('supplier');
        $itemNames = $request->input('sparepart');
        $qtys = $request->input('qty');
        $cabangs = $request->input('id_cabang');
        $hargas = $request->input('harga');
        $notx = tambahstok::generateNomor();
        // Loop melalui data input
        foreach ($itemNames as $index => $itemName) {
            // Buat instance model tambahstok
            $tambahStok = new tambahstok;

            // Set atribut-atribut model
            $tambahStok->id_tx = $notx;
            $tambahStok->id_cabang = $cabangs;
            $tambahStok->tgl_pbl = $tgls;
            $tambahStok->nopo = $nopos;
            $tambahStok->id_spr = $itemName;
            $tambahStok->id_supplier = $suppliers;
            $tambahStok->qty = $qtys[$index];
            $tambahStok->harga = $hargas[$index];

            // Simpan model ke database
            $tambahStok->save();
        }



        return redirect()->route('add_sparepart')->with('success', 'Data sparepart berhasil ditambahkan.');
        // Melakukan redirect dan menyertakan pesan sukses

    }

    //Sparepart in
    public function txsparepartout()
    {

        $users = user::all();
        $sparepart = Sparepart::where('stok', '>', 0)->get();
        $cabang = session('cabang');
        return view('Masterdata.sparepart.outsparepart', compact('sparepart', 'users', 'cabang'));
    }

    //Sparepart in
    public function requestsparepart()
    {
        $users = user::all();
        $sparepart = Sparepart::where('stok', '>', 0)->get();
        $cabang = session('cabang');
        return view('Masterdata.sparepart.requestsparepart', compact('sparepart', 'users', 'cabang'));
    }

    //Sparepart in
    public function historyrequest()
    {

        $items = keluarstok::where('user_id', '=', getUserId())->get();
        $groupedHistory = $items->groupBy('id_tx');
        return view('Masterdata.sparepart.historyrequestsparepart', compact('items', 'groupedHistory'));
    }

    //Sparepart in
    public function detailrequestsparepart($id)
    {
  $items = keluarstok::where('user_id', '=', getUserId())->get();
    
        $users = user::all();
        $sparepart = Sparepart::where('stok', '>', 0)->get();
        $cabang = session('cabang');
      
        $data = keluarstok::findOrFail($id);
        $items = keluarstok::where('id_tx', $data->id_tx)->get();
        $groupedHistory = $items->groupBy('id_tx');
        return view('Masterdata.sparepart.detailrequestsparepart', compact('users', 'sparepart', 'cabang', 'data', 'groupedHistory'));
        
    }

       //edit Sparepart Request
       public function editrequestsparepart($id)
       {
       
           $users = user::all();
           $sparepart = Sparepart::where('stok', '>', 0)->get();
           $cabang = session('cabang');
         
           $data = keluarstok::findOrFail($id);
           $items = keluarstok::where('id_tx', $data->id_tx)->get();
           $groupedHistory = $items->groupBy('id_tx');
           return view('Masterdata.sparepart.editrequestsparepart', compact('users', 'sparepart', 'cabang', 'data', 'groupedHistory'));
           
       }

        //edit Sparepart Request
        public function editrequestsparepartproses(Request $request, $id)
        {
        

          
            $data = keluarstok::findOrFail($id);

            
            return redirect()->route('detailrequest_sparepart', $id);
            
        }

    //transaksi sparepart
    public function txsparepartoutproses(Request $request)
    {

        $tgls = $request->input('tgl_permintaan');
        $users = $request->input('user_id');
        $cabangs = $request->input('id_cabang');
        $itemNames = $request->input('sparepart');
        // dd($itemNames);
        $qtys = $request->input('qty');
        $keterangan = $request->input('keterangan');
        $status =  $request->input('status');
        $notx = keluarstok::generateNomor();

        // Loop melalui data input
        foreach ($itemNames as $index => $itemName) {
            // Buat instance model keluarstok
            $keluarstok = new keluarstok;
            // Set atribut-atribut model
            $keluarstok->id_tx = $notx;
            $keluarstok->user_id = getUserId();
            $keluarstok->cabang_id = $cabangs;
            $keluarstok->tgl_permintaan = $tgls;
            $keluarstok->id_spr = $itemName;
            $keluarstok->keterangan = $keterangan;
            $keluarstok->status = $status;
            $keluarstok->qty = $qtys[$index];


            // Simpan model ke database
            $keluarstok->save();
        }


        if ($status == 1) {
            return redirect()->route('request_sparepart')->with('success', 'Data sparepart berhasil dikeluarkan.');
            // Melakukan redirect dan menyertakan pesan sukses

        } else {
            return redirect()->route('out_sparepart')->with('success', 'Data sparepart berhasil dikeluarkan.');
            // Melakukan redirect dan menyertakan pesan sukses

        }
    }
    public function storesparepart(Request $request)
    {
        $request->validate([
            'nama_sparepart' => 'required',

        ]);


        $sparepart = new Sparepart;
        $sparepart->nama_sparepart = $request->input('nama_sparepart');
        $sparepart->supplier = $request->input('supplier');
        $sparepart->stok = 0;
        $sparepart->harga = 0;
        $sparepart->id_cabang = getUserCabang();

        $sparepart->save();

        // Sparepart::create($request->all());
        // // Membuat data sparepart baru berdasarkan data yang diambil dari request

        return redirect()->route('add_sparepart')->with('success', 'Data sparepart berhasil ditambahkan.');
        // Melakukan redirect dan menyertakan pesan sukses
    }


    public function updatesparepart(Request $request, $id)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'supplier' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required',
            'tgl_pbl' => 'required|date',
        ]);


        $sparepart = Sparepart::find($id);
        $sparepart->nama_sparepart = $request->input('nama_sparepart');
        $sparepart->supplier = $request->input('supplier');
        $sparepart->stok = $request->input('stok');
        $sparepart->harga = $request->input('harga');
        $sparepart->tgl_pbl = $request->input('tgl_pbl');
        $sparepart->id_cabang = $request->input('id_cabang');

        $sparepart->save();

        // Sparepart::create($request->all());
        // // Membuat data sparepart baru berdasarkan data yang diambil dari request

        return redirect()->route('sparepart')->with('success', 'Data sparepart berhasil ditambahkan.');
        // Melakukan redirect dan menyertakan pesan sukses
    }

    public function editsparepart($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        // Melakukan pengecekan apakah data dengan ID yang diberikan ditemukan atau tidak

        return view('sparepart.edit', compact('sparepart'));
        // Mengirimkan data sparepart ke view 'edit'
    }



    public function hapussparepart($id)
    {
        $data = Sparepart::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return redirect()->route('sparepart')->with('success', 'Data berhasil dihapus');
    }

    public function updates(Request $request)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'supplier' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required',
            'tgl_pbl' => 'required|date',
        ]);


        $sparepart = new Sparepart;
        $sparepart->nama_sparepart = $request->input('nama_sparepart');
        $sparepart->supplier = $request->input('supplier');
        $sparepart->stok = $request->input('stok');
        $sparepart->harga = $request->input('harga');
        $sparepart->tgl_pbl = $request->input('tgl_pbl');
        $sparepart->id_cabang = $request->input('id_cabang');

        $sparepart->save();

        // Sparepart::create($request->all());
        // // Membuat data sparepart baru berdasarkan data yang diambil dari request

        return redirect()->route('sparepart')->with('success', 'Data sparepart berhasil ditambahkan.');
        // Melakukan redirect dan menyertakan pesan sukses
    }
}
