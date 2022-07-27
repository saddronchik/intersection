<?php

namespace App\Exports;

use App\Models\Avto;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class AvtosExport implements FromView
/**
    * @return \Illuminate\Support\Collection
   */
{
    public function view(): View
    {
        $avtos = Avto::all();

        return view('export.avtos', [
            'avtos' => $avtos 
        ]);
    }
}
 