<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tambahstok extends Model
{
    use HasFactory;
    protected $table = "tb_tambahstok";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'id_tx', 'nopo', 'id_spr', 'qty', 'harga', 'id_supplier', 'id_cabang', 'created_at', 'updated_at', 'deleted_at',
    ];

    public static function generateNomor()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Ambil nomor terakhir dari bulan ini
        $lastDocument = tambahstok::where('id_tx', 'like', 'IN/' . $currentMonth . $currentYear . '/%')
            ->orderBy('id_tx', 'desc')
            ->first();

        $newNumber = '001'; // Nomor default jika belum ada dokumen pada bulan ini

        if ($lastDocument) {
            // Ambil nomor terakhir dan increment nomor
            $lastNumber = substr($lastDocument->id_tx, -3);
            $newNumber = str_pad((int) $lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        return 'IN/' . $currentMonth . $currentYear . '/' . $newNumber;
    }
}
