<?php

namespace App\Imports;

use App\Models\Avto;
use App\Models\Border;
use App\Models\Citizen;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class BordersImportNoHead implements ToModel
{
    
 
    // use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        return new Border([
            'id_citisen'=> $row[0],
            'full_name' => $row[1], 
            'citizenship'    => $row[2], 
            // 'date_birth' => Date::excelToDateTimeObject($row[4]),
            'date_birth' => $row[3],
            'passport' => $row[4],
            'crossing_date' => $row[5],
            // 'crossing_date' => Date::excelToDateTimeObject($row[6]),
            'crossing_time' =>$row[6],
            'way_crossing' => $row[7],
            'checkpoint' => $row[8],
            'route' => $row[9],
            'place_birth' => $row[10],
            'place_regis' => $row[11],
            'user' => $row[12],
            'id_user' => $row[13],
        ]);
        
    }
}
