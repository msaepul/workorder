<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tb_supplier";
    protected $primarykey = "id";
    protected $fillable = [
        'id', 'nama_supplier', 'alamat'
    ];
}
