<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departemen extends Model
{
    protected $table = "departemen";
    protected $primarykey ="id";
    protected $fillable = [
        'id','departemen','updated_at','created_at'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
