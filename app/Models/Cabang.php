<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cabang extends Model
{
    protected $fillable = [
        'id','cabang'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
