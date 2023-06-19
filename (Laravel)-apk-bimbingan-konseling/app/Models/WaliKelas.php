<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $table = "wali_kelas";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kelas(){
        return $this->hasOne(kelas::class);
    }

    public function petakerawanan(){
        return $this->hasMany(petakerawanan::class);
    }
}
