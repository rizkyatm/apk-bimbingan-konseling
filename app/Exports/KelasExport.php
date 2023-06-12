<?php

namespace App\Exports;

use App\Models\Kelas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class KelasExport implements FromView
{
    use Exportable;
    
    public function view(): View
    {
        $datakelas = Kelas::with('guru', 'walikelas')->get();
        // dd($datakelas);
        return view('export.kelas', compact('datakelas'));
    }
}
