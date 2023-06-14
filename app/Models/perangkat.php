<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perangkat extends Model
{
    use HasFactory;

    protected $table = "tb_perangkat";
    protected $primaryKey = "id";

    protected $fillable = [
        'nama_perangkat',
        'id_jenis',
        'id_brand',
        'id_type',
        'spesifikasi',
        'date_purchase',
        'user_id',
        'cabang_id',
        'dept_id',
        'id_teamviewer',
        'id_anydesk',
        'ip',
        'mac_address',
        'status',
        'nopo',
        'supplier',
        'harga',

        'created_at',
        'deleted_at'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'user_id');
    }
    public function type()
    {
        return $this->belongsTo(type::class, 'id');
    }

    // public function brand()
    // {
    //     return $this->belongsTo(brand::class, 'id');
    // }
  
}
