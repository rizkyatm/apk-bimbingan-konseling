<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "siswas";
    protected $primaryKey = "id";
    protected $guarded = [];

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function konseling_bk(){
        return $this->hasMany(Konseling_bk::class);
    }

    public function jenispetakerawanan(){
        return $this->hasMany(JenisPetaKerawanan::class);
    }
}
