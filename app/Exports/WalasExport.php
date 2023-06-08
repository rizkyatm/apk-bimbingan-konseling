<?php

namespace App\Exports;

use App\Models\walas;
use Maatwebsite\Excel\Concerns\FromCollection;

class WalasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return walas::all();
    }
}
