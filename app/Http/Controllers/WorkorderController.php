<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\perangkat;
use App\Models\Sparepart;
use App\Models\workorder;
use App\Models\keluarstok;
use Illuminate\Http\Request;
use App\Exports\WorkordersExport;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


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
    public function datawoall()
    {
        // $departemen = Departemen::all();


        $workorders = workorder::all();

        $users = User::all()->first();
        return view('Workorder.datawoall', compact('workorders'));
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
        $dept = Auth::user()->dept;
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
        $workorder->level = $request->input('level');
        $workorder->perangkat_id = $request->input('perangkat_id');
        $workorder->wo_create = $request->input('tgl_dibuat');
        $workorder->keadaan = $request->input('keadaan');
        $workorder->obyek = $request->input('obyek');
        $workorder->user_id = $request->input('user_id');
        $workorder->status = 1;
        $workorder->cabang_id = $cabang;
        $workorder->dept = $dept;
        $workorder->lampiran = $lampiran;

        // Simpan $workorder ke database
        $workorder->save();

        $idwo = workorder::where('no_wo', $generate)->max('id');
        return redirect()->route('Workorder_detail', $idwo);
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



        $status = $workorders->status;
        $sparepart = Sparepart::where('id_cabang', '=', getUserCabang())->where('stok', '>', 0)->get();

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
        // Simpan $workorder ke database
        $workorder->save();
        return redirect()->route('Workorder_detail', $id);
    }

    public function updateStatus(Request $request, $id)
    {

        $status = $request->input('status');
        // Lakukan pembaruan status sesuai dengan nilai yang dikirimkan
        $data = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan data yang sesuai


        if ($status == 2) {
            $item = Workorder::find($id);
            $item->date_confirm = now();
            $item->status = 2;
            $EDP = User::where('cabang', $item->cabang_id)->where('dept', "EDP")->where('no_wa', '!=', '0')->first();

            $response = WhatsAppService::sendMessage(
                getNoUser($item->user_id),
                "Halo " . getFullName($item->user_id) . ", Work Order yang Anda buat dengan detail:\nNomor: *$item->no_wo*\nStatus saat ini: *CONFIRM*\nPada tanggal: $item->date_confirm.\n\nIni adalah pesan otomatis BOT Arnon Bakery",
                "https://file-url.com"
            );
            $response = WhatsAppService::sendMessage(
                $EDP->no_wa,
                "Halo " . getFullName($item->user_id) . ", Work Order yang Anda buat dengan detail:\nNomor: *$item->no_wo*\nStatus saat ini: *CONFIRM*\nPada tanggal: $item->date_confirm.\n\nIni adalah pesan otomatis BOT Arnon Bakerya asfafasfas",
                "https://file-url.com"

            );



            $item->save();
        } elseif ($status == 0) {
            $item = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
            $item->status = 0;
            $item->save();
        } elseif ($status == 3) {
            $item = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
            $item->userfix_id = $request->input('userfix_id');
            $item->date_start = $request->input('date_start');
            $item->date_end = $request->input('date_end');
            $response = WhatsAppService::sendMessage(
                "08112131669",
                "Your Message",
                "https://file-url.com"
            );
            $item->status = 3;
            $item->save();
        } elseif ($status == 4) {
            $itemNames = $request->input('part');
            $qtys = $request->input('qty');
            $notx = keluarstok::generateNomor();
            $currentDateTime = now();
            $formattedDate = $currentDateTime->format('Y-m-d');
            $response = WhatsAppService::sendMessage(
                "08112131669",
                "Your Message",
                "https://file-url.com"
            );
            if ($itemNames[0] === null) {
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
        } elseif ($status == 5) {
            $item = Workorder::find($id); // Ganti dengan logika Anda untuk mendapatkan item yang sesuai
            $item->status = 5;
            $item->user_validasi = getUserId();
            $item->date_validasi = now();
            $item->save();
            $response = WhatsAppService::sendMessage(
                "08112131669",
                "Your Message",
                "https://file-url.com"
            );
        }
        // Kembalikan respon atau lakukan pengalihan (redirect) ke halaman yang sesuai
        return redirect()->route('Workorder_detail', $id)->with($response);
    }


    public function generatePDF($id)
    {

        $now = Carbon::now()->tz('Asia/Jakarta');
        $dateTime = $now->toDateTimeString();
        // Mengambil data berdasarkan ID
        $workorders = workorder::findOrFail($id);

        $data = $workorders->id_tx;
        $items = keluarstok::where('id_tx', $data)->get();
        $groupedHistory = $items->groupBy('id_tx');


        $html = '<style>';
        $html .= 'body { border: 1px solid black; padding: 20px; }';
        $html .= 'table { border-collapse: collapse; width: 100%; }';
        $html .= 'th, td { border: 1px solid black;  }';
        $html .= 'th { background-color: #f2f2f2; }';
        $html .= '.border-left { border :none; border-left: 1px solid black;  }';
        $html .= '.border-right { border :none; border-right: 1px solid black; text-align: left;  padding-left: 40px; }';
        $html .= '</style>';

        $html .= '<table>';

        $html .= '<tr>';
        // $html .= '<th rowspan="2"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png" style="width:20%;"></th>';
        $html .= '<th rowspan="2">Logo</th>';

        $html .= '<th rowspan="2"></th>';
        $html .= '<th  rowspan="2"></th>';
        $html .= '<th rowspan="2" colspan="3">Form Work Order</th>';
        $html .= '<th rowspan="2"></th>';
        $html .= '<th  rowspan="2"></th>';
        $html .= '<th><p>EDP-01 Rev.01</p></th>';
        $html .= '</table>';

        $html .= '<table>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<th></th>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td"></td>';
        $html .= '<td"></td>';
        $html .= '<td"></td>';
        $html .= '<td"></td>';
        $html .= '<td"></td>';
        $html .= '</tr>';

        $html .= '</table>';





        // foreach ($users as $user) {
        //     $html .= '<tr><td>' . $user->nama_lengkap . '</td><td>' . $user->email . '</td></tr>';
        // }
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 685.98, 515.85], 'lanskap');

        // Render HTML to PDF
        $dompdf->render();

        // Save or display the PDF
        $dompdf->stream('output.pdf', ['Attachment' => false]);
    }
    public function export()
    {
        return Excel::download(new WorkordersExport, 'WO.xlsx');
    }

    public function exportWOCabang()
    {
        $cabang = caricabang(@$_GET['cabang']);
        $bulan = strtoupper(bln(@$_GET['bulan']));
        $jenis = @$_GET['jenis'];

        return Excel::download(new WorkordersExport, 'WO - ' . $bulan . $cabang . '.xlsx');
    }
}
