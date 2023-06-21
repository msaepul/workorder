<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\Jenis;
use App\Models\brand;
use App\Models\type;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartController extends Controller
{

    public function sparepart()

    {
        $sparepart = Sparepart::all();
        $results = [];

        foreach ($sparepart as $part) {
            $result = $part->harga * $part->stok;
            $results[] = $result;
        }
        // $sparepart = 
        return view('Masterdata.sparepart.sparepart', compact('sparepart', 'results'));
    }
    public function createsparepart()
    {
        $sparepart = Sparepart::all();
        $cabang = session('cabang');




        return view('Masterdata.sparepart.addsparepart', compact('sparepart', 'cabang'));
    }

    public function storesparepart(Request $request)
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

    public function editsparepart($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        // Melakukan pengecekan apakah data dengan ID yang diberikan ditemukan atau tidak

        return view('sparepart.edit', compact('sparepart'));
        // Mengirimkan data sparepart ke view 'edit'
    }



    public function updatesparepart(Request $request, $id)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'supplier' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'tgl_pbl' => 'required|date',
        ]);

        $sparepart = Sparepart::findOrFail($id);
        // Melakukan pengecekan apakah data dengan ID yang diberikan ditemukan atau tidak

        $sparepart->update($request->all());
        // Mengupdate data sparepart dengan data yang diambil dari request

        return redirect()->route('sparepart.index')->with('success', 'Data sparepart berhasil diperbarui.');
        // Melakukan redirect dan menyertakan pesan sukses
    }
}
