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
}
