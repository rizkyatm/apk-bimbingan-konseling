<?php

namespace App\Exports;

use App\Models\PetaKerawanan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class PetaKerawananExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $data = PetaKerawanan::all();
        return view('Export.petakerawanan', compact('data'));
    }

}
