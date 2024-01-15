<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dept extends Model
{
    protected $table = "tb_dept";
    protected $primarykey = "id";
    protected $fillable = [
        'id','dept','ket'
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
