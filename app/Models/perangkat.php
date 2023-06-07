<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perangkat extends Model
{
    use HasFactory;

    protected $table = "tb_perangkat";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'nama_perangkat',
        'jenis_perangkat',
        'id_brand',
        'id_type',
        'spesifikasi',
        'date_purchase',
        'user_id',
        'id_teamviewer',
        'id_anydesk',
        'ip',
        'mac_address',
        'created_at',
        'deleted_at'
        
    ];
}
