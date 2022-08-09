<?php

namespace App\Exports;



// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class BordersExport implements FromView
/**
    * @return \Illuminate\Support\Collection
   */
{
    public function view(): View
    {
        $borders = DB::table('borders')
        ->join('citizens','citizens.id','=','borders.id_citisen')
        ->join('avtos','avtos.id','=','borders.way_crossing')
        ->select('borders.id_citisen','citizens.id','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date','borders.crossing_time','borders.way_crossing', 'avtos.id','avtos.brand_avto','borders.checkpoint','borders.route','borders.place_birth','borders.place_regis','borders.user','borders.id_user')
        ->get();



        return view('export.borders', [
            'borders' => $borders 
        ]);
    }
}

