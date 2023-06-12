<?php

namespace App\Exports;

use App\Models\walikelas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class WalasExport implements FromView
{
  use Exportable;

  public function view(): View
  {
    $datawalikelas = walikelas::with('user')->get();
    // dd($datawalikelas);
    return view('export.walikelas', compact('datawalikelas'));
  }
}
