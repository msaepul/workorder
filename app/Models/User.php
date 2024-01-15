<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use App\Models\Cabang;
// use App\Models\Departemen;
use Laravel\Sanctum\HasApiTokens;
use JetBrains\PhpStorm\Deprecated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table        =   'tb_login';
    protected $primaryKey   =   'id';

    protected $fillable     = ['dept', 'cabang', 'nama_lengkap', 'email', 'password', 'spassword', 'no_telegram', 'no_wa', 'level', 'spassword'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class,'id','cabang');
    }
    
    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
    public function perangkat()
    {
        return $this->hasMany(perangkat::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $attributes = [
    //     'role' => 2,

    // ];
}
