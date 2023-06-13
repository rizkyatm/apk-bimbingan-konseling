<?php

namespace App\Exports;

use App\Models\Guru;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class GuruExport implements FromView
{
    use Exportable;
    
    public function view(): View
    {
        $dataguru = Guru::with('user')->get();
        return view('export.guru', compact('dataguru'));
    }
}
