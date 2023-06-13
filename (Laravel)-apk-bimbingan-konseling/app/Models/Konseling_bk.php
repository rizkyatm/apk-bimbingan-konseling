<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling_bk extends Model
{
    use HasFactory;

    protected $table = "konseling_bks";
    protected $primaryKey = "id";
    protected $guarded = [];


    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function wali_kelas(){
        return $this->belongsTo(WaliKelas::class , 'walas_id');
    }

    public function layanan_bk(){
        return $this->belongsTo(Layanan_bk::class, 'layanan_id');
    }
    


}
