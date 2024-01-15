<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $table = "tb_jenis";
    protected $primaryKey = "id";

    protected $fillable = [
        'jenis_perangkat',
        
    ];
}
