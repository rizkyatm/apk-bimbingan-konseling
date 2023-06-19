<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petakerawanan extends Model
{
    use HasFactory;
    protected $table = 'petakerawanan';
    protected $primaryKey = "id";
    protected $guarded = [];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function walikelas(){
        return $this->belongsTo(walikelas::class);
    }
}
