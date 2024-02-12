<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\supplier;
use App\Models\Sparepart;
use App\Models\keluarstok;
use App\Models\tambahstok;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Storage;

class SparepartController extends Controller
{

    public function sparepart()

    {

        $sparepart = Sparepart::where('id_cabang', '=', getUserCabang())->where('stok', '>', 0)->get();
        $results = [];

        foreach ($sparepart as $part) {
            $result = $part->harga * $part->stok;
            $results[] = $result;
        }
        // $sparepart = 
        return view('Masterdata.sparepart.sparepart', compact('sparepart', 'results'));
    }

    public function masterSparepart()

    {

        $sparepart = Sparepart::where('id_cabang', '=', getUserCabang())->get();

        return view('Masterdata.sparepart.mastersparepart', compact('sparepart'));
    }

    public function masteredit(Request $request, $id)
    {
        // Validate the request data as needed
        $validatedData = $request->validate([
            'nama_sparepart' => 'required|string|max:255',
            'ket_sparepart' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        $sparepart = Sparepart::findOrFail($id);

        // Update the sparepart with the validated data
        $sparepart->update($validatedData);

        // Redirect to the sparepart list or wherever you need to go after the update
        return redirect()->route('mastersparepart')->with('success', 'Data Sparepart Berhasil di Update');
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

    public function txsparepartout()
    {

        $users = user::all();
        $sparepart = Sparepart::where('stok', '>', 0)->get();
        $cabang = session('cabang');
        return view('Masterdata.sparepart.outsparepart', compact('sparepart', 'users', 'cabang'));
    }

    //Sparepart Request
    public function requestsparepart()
    {
        $users = user::all();
        $sparepart = Sparepart::where('stok', '>', 0)
            ->where('id_cabang', '=', getUserCabang())
            ->get();
        $cabang = session('cabang');
        return view('Masterdata.sparepart.requestsparepart', compact('sparepart', 'users', 'cabang'));
    }


    public function historyrequest()
    {

        if (getUserDept() == "EDP") {
            $items = keluarstok::where('cabang_id', '=', getUserCabang())->get();
        } else {
            $items = keluarstok::where('user_id', '=', getUserId())->get();
        }
        $groupedHistory = $items->groupBy('id_tx');
        return view('Masterdata.sparepart.historyrequestsparepart', compact('items', 'groupedHistory'));
    }


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

    public function updatestatus(Request $request, $id)
    {
        $status = $request->input('status');
        $data = keluarstok::findOrFail($id);
        $items = keluarstok::where('id_tx', $data->id_tx)->get();
        $groupedHistory = $items->groupBy('id_tx');

        foreach ($groupedHistory as $idTx => $items) {
            if ($status == 2) {
                // Lakukan aksi untuk status = 1
                foreach ($items as $item) {
                    $item->qty;
                    $item->status = 2;
                    $item->save();
                }
            } elseif ($status == 0) {
                foreach ($items as $item) {
                    $item->status = 0;
                    $item->save();
                }
            } elseif ($status == 3) {
                foreach ($items as $item) {
                    $item->qty;
                    $item->status = 3;
                    $item->save();
                }
            }
        }
        return redirect()->route('detailrequest_sparepart', $id);
    }
    //edit Sparepart Request
    public function editrequestsparepart($id)
    {

        $users = user::all();
        $sparepart = Sparepart::where('stok', '>', 0)
            ->where('id_cabang', '=', getUserCabang())
            ->get();
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
        $items = keluarstok::where('id_tx', $data->id_tx)->get();
        $groupedHistory = $items->groupBy('id_tx');

        $spareparts = $request->sparepart;
        $qtys = $request->qty;

        foreach ($groupedHistory as $idTx => $group) {
            foreach ($group as $key => $item) {
                $item->id_spr = $spareparts[$key];
                $item->qty = $qtys[$key];
                $item->keterangan = $request->keterangan;
                $item->save();
            }
        }

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
            $idwo = keluarstok::where('id_tx', $notx)->max('id');
            $EDP = User::where('cabang', $cabangs)->where('dept', "EDP")->where('no_wa', '!=', '0')->first();
            $items = keluarstok::where('id_tx', $notx)->get();
            $item = keluarstok::where('id_tx', $notx)->first();
            $groupedHistory = $items->groupBy('id_tx');
            $barangNames = $groupedHistory->map(function ($group) {
                return $group->pluck('id_spr')->map(function ($id_spr) {
                    return getNamesparepart($id_spr);
                })->toArray();
            });
            $response = WhatsAppService::sendMessage(
                getNoUser(getUserId()),
                "Halo " . getFullName(getUserId()) . ", Permintaan Sparepart anda telah dibuat dengan detail:\nNomor Transaksi: *$notx* \nTanggal Dibuat: $tgls.\nDetail Barang: " . implode(', ', $barangNames->first()) . "\n\nIni adalah pesan otomatis BOT Arnon Bakery",
                null
            );

            $response = WhatsAppService::sendMessage(
                $EDP->no_wa,
                "Halo " . getFullName($EDP->id) . ", Terdapat Permintaan Sparepart anda telah dibuat dengan detail:\nNomor Transaksi: *$notx* \nDiminta oleh:" . getFullName($item->user_id) . "\nTanggal Dibuat: $tgls.\nDetail Barang: " . implode(', ', $barangNames->first()) . "\n\nIni adalah pesan otomatis BOT Arnon Bakery",
                null
            );


            return redirect()->route('detailrequest_sparepart', $idwo)->with('success', 'Data Permintaan Berhasil Ditambahkan.')->with($response);
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

        return back()->with('success', 'Data sparepart berhasil ditambahkan.');
        // Redirect back and include success message

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

        return redirect()->route('sparepart')->with('success', 'Data sparepart berhasil Dirubah.');
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

        return redirect()->back()->with('success', 'Data berhasil dihapus');
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
