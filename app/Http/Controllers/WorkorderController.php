<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\perangkat;
use App\Models\Sparepart;
use App\Models\workorder;
use App\Models\keluarstok;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WorkordersExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


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

        if (getUserdept() == 'EDP') {
            $workorders = workorder::where('cabang_id', '=', $cabang)->get();
        } else {
            $workorders = workorder::where('user_id', '=', $user)->get();
        }
        $users = User::all()->first();
        return view('Workorder.datawo', compact('users', 'workorders'));
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
        $now = Carbon::now()->tz('Asia/Jakarta');
        $dateTime = $now->toDateTimeString();
        // Mengambil data berdasarkan ID
        $workorders = workorder::findOrFail($id);

        $data = $workorders->id_tx;
        $items = keluarstok::where('id_tx', $data)->get();
        $groupedHistory = $items->groupBy('id_tx');

   
        $no_wo = $workorders->lampiran;
        $status = $workorders->status;
        $sparepart = Sparepart::where('id_cabang', '=', getUserCabang())->get();


        if ($no_wo !== null) {
            // Pisahkan string berdasarkan delimiter '/'
            $parts = explode('/', $no_wo);

            // Ambil bagian-bagian yang diperlukan
            $cabang = cabang();
            $tahun = $parts[1];
            $bulan = $parts[2];
            $nomor = $parts[3];

            // Gabungkan bagian-bagian menjadi string yang diinginkan
            $lampiran = 'Lampiran/Wo/' . $cabang . '/' . $tahun . '/' . bulan_angka($bulan) . '/' . $nomor;
        } else {
            $lampiran = "null";
        }
        if ($status >= 4) {
            return view('Workorder.result', compact('workorders', 'lampiran', 'dateTime', 'data', 'groupedHistory'));
        } elseif ($status > 2 && $status <= 3) {
            return view('Workorder.detailedp', compact('workorders', 'lampiran', 'sparepart', 'dateTime'));
        } elseif ($status <= 2) {
            return view('Workorder.detail', compact('workorders', 'lampiran', 'dateTime'));
        }
        
    }

    public function editwo($id)
    {

        // Mengambil data berdasarkan ID
        $workorders = workorder::findOrFail($id);
        $listperangkat = perangkat::where('user_id', '=', getUserID())->get();

        $no_wo = $workorders->lampiran;

        if ($no_wo !== null) {
            // Pisahkan string berdasarkan delimiter '/'
            $parts = explode('/', $no_wo);

            // Ambil bagian-bagian yang diperlukan
            $cabang = cabang();
            $tahun = $parts[1];
            $bulan = $parts[2];
            $nomor = $parts[3];

            // Gabungkan bagian-bagian menjadi string yang diinginkan
            $lampiran = 'Lampiran/Wo/' . $cabang . '/' . $tahun . '/' . bulan_angka($bulan) . '/' . $nomor;
        } else {
            $lampiran = "null";
        }

        return view('Workorder.edit', compact('workorders', 'lampiran', 'listperangkat'));
    }
    public function editwoproses(Request $request, $id)
    {

        $cabang = Auth::user()->cabang;
        $workorder = workorder::findOrFail($id);

        $no_wo = $workorder->no_wo;

        if ($no_wo !== null) {
            // Pisahkan string berdasarkan delimiter '/'
            $parts = explode('/', $no_wo);

            // Ambil bagian-bagian yang diperlukan
            $getcabang = cabang();
            $tahun = $parts[1];
            $bulan = $parts[2];
            $nomor = $parts[3];

            // Gabungkan bagian-bagian menjadi string yang diinginkan WO-HO/2023/VI/020
            $lampiran = 'Lampiran/Wo/' . $getcabang . '/' . $tahun . '/' . bulan_angka($bulan);
        } else {
            $lampiran = "null";
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $tujuan_upload = $lampiran;
            $nama_lampiran = "{$no_wo}.{$file->getClientOriginalExtension()}";
            $nama_file = "{$nomor}.{$file->getClientOriginalExtension()}";
            $file->move($tujuan_upload, $nama_file);
            $nama_lampiran = "{$no_wo}.{$file->getClientOriginalExtension()}";
        } else {
            $nama_lampiran = null;
        }

        $workorder->kategori_wo = $request->input('kategori_wo');
        $workorder->perangkat_id = $request->input('perangkat_id');
        $workorder->wo_create = $request->input('tgl_dibuat');
        $workorder->keadaan = $request->input('keadaan');
        $workorder->obyek = $request->input('obyek');
        $workorder->user_id = $request->input('user_id');
        $workorder->status = 1;
        $workorder->cabang_id = $cabang;
        $workorder->lampiran = $nama_lampiran;
        // dd($lampiran);   
        // Simpan $workorder ke database
        $workorder->save();
        return redirect()->route('Workorder_detail', $id);
    }

    public function updateStatus(Request $request, $id)
    {

      
        $status = $request->input('status');
        // Lakukan pembaruan status sesuai dengan nilai yang dikirimkan
        $data = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan data yang sesuai

        // Lakukan pembaruan status sesuai dengan nilai yang dikirimkan
        if ($status == 2) {
            // Lakukan aksi untuk status = 1
            $item = Workorder::find($id); 
            // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
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
            $item->userfix_id =$request->input('userfix_id');
            $item->date_start =$request->input('date_start');
            $item->date_end=$request->input('date_end');

            $item->status = 3;
            $item->save();
        } elseif ($status == 4) {
            $itemNames = $request->input('part');
            $qtys = $request->input('qty');
            $notx = keluarstok::generateNomor();
            $currentDateTime = now();
            $formattedDate = $currentDateTime->format('Y-m-d');
            // dd(count($itemNames));
            if ($itemNames[0] === null)  {
                $item = Workorder::find($id);
                $item->id_tx = null;
                $item->analisa = $request->input('analisa');
                $item->tindakan = $request->input('tindakan');
                $item->date_actual = $request->input('date_actual');
                $item->status = 4;
                $item->save();
            } else {
                foreach ($itemNames as $index => $itemName) {
                    // Buat instance model keluarstok
                    $keluarstok = new keluarstok;
                    $keluarstok->id_tx = $notx;
                    $keluarstok->id_spr = $itemName;
                    $keluarstok->qty = $qtys[$index];
                    $keluarstok->tgl_permintaan = $formattedDate;
                    $keluarstok->user_id = $data->user_id;
                    $keluarstok->status = 3;
                    $keluarstok->cabang_id = getUserCabang();
                    
                    // Simpan model ke database
                    $keluarstok->save();
                }
                $item = Workorder::find($id);
                $item->id_tx = $notx;
                $item->analisa = $request->input('analisa');
                $item->tindakan = $request->input('tindakan');
                $item->date_actual = $request->input('date_actual');
                $item->status = 4;
                $item->save();
            }
            
         }elseif ($status == 5) {
            // Lakukan aksi untuk status = 5
            $item = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
            $item->status = 5;
            $item->save();}
        // Kembalikan respon atau lakukan pengalihan (redirect) ke halaman yang sesuai
        return redirect()->route('Workorder_detail', $id);

    }

    public function generatePDF($id){

        $now = Carbon::now()->tz('Asia/Jakarta');
        $dateTime = $now->toDateTimeString();
        // Mengambil data berdasarkan ID
        $workorders = workorder::findOrFail($id);

        $data = $workorders->id_tx;
        $items = keluarstok::where('id_tx', $data)->get();
        $groupedHistory = $items->groupBy('id_tx');

   
        $no_wo = $workorders->lampiran;
        $status = $workorders->status;
        $sparepart = Sparepart::where('id_cabang', '=', getUserCabang())->get();


        $html = '<style>';
        $html .= 'body { border: 1px solid black; padding: 20px; }';
        $html .= 'table { border-collapse: collapse; width: 100%; }';
        $html .= 'th, td { border: 1px solid black; padding: 5px;  }';
        $html .= 'th { background-color: #f2f2f2; }';
        $html .= '.border-left { border :none; border-left: 1px solid black;  }';
        $html .= '.border-right { border :none; border-right: 1px solid black; text-align: left;  padding-left: 40px; }';
        $html .= '</style>';
        
        $html .= '<table>';

        $html .= '<tr>';
        // $html .= '<th rowspan="2"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png" style="width:20%;"></th>';
        $html .= '<th rowspan="2">Logo</th>';


        $html .= '<th rowspan="2" colspan="2">Form Work Order</th>';
        $html .= '<th>'.$workorders->no_wo.'</th>'; 
   
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th>'.$workorders->wo_create.'</th>';
        $html .= '</tr>';
        
        $html .= '<td colspan="4" style="text-align: center; border-bottom: 1px solid black; background-color: #f2f2f2;"> Informasi Work Order </td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td class="border-left"> Pembuat </td>';
        $html .= '<td style="border: none;"> : '.getFullName($workorders->user_id).'</td>';
        $html .= '<td style="border: none; text-align: right;">Pelaksana</td>';
        $html .= '<td class="border-right"> : '.getFullName($workorders->userfix_id).'</td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td class="border-left"> Jenis WO </td>';
        $html .= '<td style="border: none;"> : '.$workorders->kategori_wo.'</td>';
        $html .= '<td style="border: none; text-align: right;">Target Selesai</td>';
        $html .= '<td class="border-right"> : '.$workorders->date_end.'</td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td class="border-left"></td>';
        $html .= '<td style="border: none;"></td>';
        $html .= '<td style="border: none; text-align: right;">Aktual Selesai</td>';
        $html .= '<td class="border-right"> : '.$workorders->date_actual.'</td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td colspan="4" style="text-align: center; border-bottom: 1px solid black; background-color: #f2f2f2;"> Informasi Masalah </td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align: center; border-right: 1px solid black;  background-color: #f2f2f2;"> Objek </td>';
        $html .= '<td colspan="2" style="text-align: center;  background-color: #f2f2f2;"> Keluhan </td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align: center; border-right: 1px solid black; padding: 30px;">'.$workorders->obyek.'</td>';
        $html .= '<td colspan="2" style="text-align: center; padding: 30px;">'.$workorders->keadaan.' </td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td colspan="4" style="text-align: center; border-bottom: 1px solid black; background-color: #f2f2f2;"> Informasi Pebaikan </td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align: center; border-right: 1px solid black ;  background-color: #f2f2f2;"> Anlisa Kerusakan </td>';
        $html .= '<td colspan="2" style="text-align: center;  background-color: #f2f2f2;"> Tindakan Perbaikan </td>';
        $html .= '</tr>';
        
        $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align: center; padding: 30px; border-right: 1px solid black;">'.$workorders->analisa.'</td>';
        $html .= '<td colspan="2" style="text-align: center; padding: 30px;">'.$workorders->tindakan.' </td>';
        $html .= '</tr>';
    
          $html .= '<tr>';
        $html .= '<td colspan="2" style="text-align: center; border-right: 1px solid black ;  background-color: #f2f2f2;">Waktu Mulai Mengerjakan </td>';
        $html .= '<td colspan="2" style="text-align: center;  background-color: #f2f2f2;"> Sparepart/sukucadang</td>';
        $html .= '</tr>';

        if ($workorders->id_tx === null) {
            $html .= '<tr>';
            $html .= '<td colspan="2" style="text-align: center;">'.$workorders->date_start.'</td>';
            $html .= '<td colspan="2" style="text-align: center;">Tidak ada sparepart yang digunakan</td>';
            $html .= '</tr>';
        } else {
            foreach ($groupedHistory as $id_tx => $group) {
                $groupSize = count($group);
                foreach ($group as $key => $item) {
                    $html .= '<tr>';
                    if ($key === 0) {
                        $html .= '<td class="align-middle text-center" style="text-align: center;" colspan="2" rowspan="' . $groupSize . '">';

                        $html .= $workorders->date_start;
                        $html .= '</td>';
                    }
                    $html .= '<td   >';
                    $html .= getNameSparepart($item['id_spr']);
                    $html .= '</td>';
                    $html .= '<td style="text-align: center;">';
                    $html .= $item['qty'];
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }
        }
        
        $html .= '</table>';
        
        
        
          // foreach ($users as $user) {
        //     $html .= '<tr><td>' . $user->nama_lengkap . '</td><td>' . $user->email . '</td></tr>';
        // }
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml($html);
        $dompdf -> setPaper ([ 0 , 0 , 685.98 , 515.85 ], 'lanskap' );

        // Render HTML to PDF
        $dompdf->render();
        
        // Save or display the PDF
        $dompdf->stream('output.pdf', ['Attachment' => false]);
        
        
      }

     public function export()
    {
        return Excel::download(new WorkordersExport, 'WO.xlsx');
    }
 
 

    
}