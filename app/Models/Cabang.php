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
        'id', 'cabang', 'ket'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
