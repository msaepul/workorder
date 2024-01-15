<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cabang extends Model
{
    protected $table = "tb_cabang";
    protected $primarykey = "id";
    protected $fillable = [
        'id', 'cabang', 'ket','updated_at','created_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id','cabang');
    }
}
