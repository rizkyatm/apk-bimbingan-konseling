<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan_bk extends Model
{
    use HasFactory;

    protected $table = "layanan_bks";
    protected $primaryKey = "id";
    protected $guarded = [];


    public function konseling_bk(){
        return $this->hasMany(Konseling_bk::class);
    }
}
