<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class keluarstok extends Model
{
    use HasFactory;
    protected $table = "tb_keluarstok";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'id_tx', 'id_spr', 'qty', 'user_id', 'id_cabang', 'created_at', 'keterangan', 'updated_at', 'deleted_at',
    ];

    public static function generateNomor()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $cabang = Auth::user()->cabang;

        // Ambil nomor terakhir dari bulan ini
        $lastDocument = keluarstok::where('id_tx', 'like', 'OUT-' . cabang($cabang) . '/' . $currentMonth . $currentYear . '/%')
            ->orderBy('id_tx', 'desc')
            ->first();

        $newNumber = '001'; // Nomor default jika belum ada dokumen pada bulan ini

        if ($lastDocument) {
            // Ambil nomor terakhir dan increment nomor
            $lastNumber = substr($lastDocument->id_tx, -3);
            $newNumber = str_pad((int) $lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        return 'OUT-' . cabang($cabang) . '/' . $currentMonth . $currentYear . '/' . $newNumber;
    }
}
