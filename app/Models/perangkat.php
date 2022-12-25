<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perangkat extends Model
{
    use HasFactory;

    protected $table = "perangkat";
    protected $primarykey = "id";
    protected $fillable = [
        'no_inventaris',
        'jenis_perangkat',
        'spesifikasi',
        'merk',
        'type',
        'harga',
        'status',
        'user_id',
        'cabang_id'
        
    ];
}
