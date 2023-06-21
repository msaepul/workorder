<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;
    protected $table = "tb_sparepart";
    protected $primaryKey = "id";

    protected $fillable = [
        'nama_sparepart',
        'supplier',
        'stok',
        'harga',
        'tgl_pbl',
        'id_cabang',
        'updated_at',
        'created_at',
    ];
}
