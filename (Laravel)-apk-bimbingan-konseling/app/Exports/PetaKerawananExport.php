<?php

namespace App\Exports;

use App\Models\PetaKerawanan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PetaKerawananExport implements FromView
{
    use Exportable;

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data = PetaKerawanan::where('walikelas_id', $this->id)->get();
        return view('Export.petakerawanan', compact('data'));
    }
}
