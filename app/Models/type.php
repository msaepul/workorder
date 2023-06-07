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
        'name_type',
        'created_at',
        'deleted_at'
        
    ];
}
