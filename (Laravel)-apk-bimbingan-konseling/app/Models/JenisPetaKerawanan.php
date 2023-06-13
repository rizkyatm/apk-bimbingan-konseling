<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPetaKerawanan extends Model
{
    use HasFactory;
    protected $table ="jenispetakerawanan";
    protected $primaryKey = "id";
    protected $fillable = [
        "siswa_id",
        "petakerawanan_id",
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function petakerawanan(){
        return $this->belongsTo(PetaKerawanan::class);
    }


}
