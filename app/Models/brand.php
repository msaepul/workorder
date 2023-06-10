<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $table = "tb_brand";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'name_brand',
        'ket_brand',
        'created_at',
        'deleted_at'
        
    ];
    public function perangkat()
    {
        return $this->hasMany(perangkat::class, 'id_brand');
    }
}
