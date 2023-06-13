<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetaKerawanan extends Model
{
    use HasFactory;

    protected $table = "petakerawanan";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function jenispetakerawanan(){
        return $this->hasMany(JenisPetaKerawanan::class);
    }
}
