<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workorder extends Model
{
    use HasFactory;

    protected $table = "workorders";
    protected $primarykey = "id";
    protected $fillable = [
        'no_wo',
        'wo_create',
        'kategori_wo',
        'jenis_perangkat',
        'lokasi',
        'obyek',
        'keadaan',
        'lampiran',
        'user_id'
    ];
    protected $attributes = [
        'status' => "draft",
        
    ];
}
