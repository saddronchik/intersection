<?php

namespace App\Exports;

use App\Models\Citizen;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CitisensExport implements FromView
/**
    * @return \Illuminate\Support\Collection
   */
{
    public function view(): View
    {
        return view('export.citisens', [
            'citisens' => Citizen::all()
        ]);
    }
}
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Citizen::all();
//     }
// }
