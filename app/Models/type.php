<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    use HasFactory;

    protected $table = "tb_type";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'id_jenis',
        'name_type',
        'ket_type',
        'updated_at',
        'created_at',
        
        
    ];
    public function perangkat()
    {
        return $this->hasMany(perangkat::class, 'id_type');
    }
}
