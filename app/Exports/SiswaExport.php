<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaExport implements FromView
{
    use Exportable;
    
    public function view(): View
    {
        $datasiswa = Siswa::with('kelas', 'user')->get();
        // dd($datasiswa);
        return view('export.siswa', compact('datasiswa'));
    }
   
}
