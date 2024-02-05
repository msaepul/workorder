<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class workorder extends Model
{
    use HasFactory;

    protected $table = "workorders";
    protected $primarykey = "id";
    protected $fillable = [
        'no_wo',
        'wo_create',
        'level',
        'kategori_wo',
        'perangkat_idanydesk',
        'lokasi',
        'obyek',
        'keadaan',
        'lampiran',
        'user_id',
        'dept',
        'userfix_id',
        'user_confirm',
        'date_confirm',
        'date_start',
        'date_validasi',
        'date_end',
        'cabang_id',
        'tindakan',
        'analisa',
        'id_tx'
    ];
    protected $attributes = [
        'status' => "draft",

    ];

    public static function generateNomor()
    {

        $currentMonth = date('m');
        $currentYear = date('Y');
        $cabang = cabang();

        // Ambil nomor terakhir dari bulan ini
        $lastDocument = workorder::where('no_wo', 'like', 'WO' . '-' . $cabang . '/' . $currentYear  . '/' . tgl_id($currentMonth) . '/%')
            ->orderBy('no_wo', 'desc')
            ->first();

        $newNumber = '001'; // Nomor default jika belum ada dokumen pada bulan ini

        if ($lastDocument) {
            // Ambil nomor terakhir dan increment nomor
            $lastNumber = substr($lastDocument->no_wo, -3);
            $newNumber = str_pad((int) $lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        return 'WO' . '-' . cabang() . '/' . $currentYear  . '/' . tgl_id($currentMonth) . '/' . $newNumber;
    }
    public static function formatTime($datetime)
    {
        return Carbon::parse($datetime)->format(' H:i:s');
    }
    public static function formatDate($datetime)
    {
        return Carbon::parse($datetime)->format('j F Y ');
    }
}
