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


}

