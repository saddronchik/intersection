<?php

namespace App\Imports;

use App\Models\Avto;
use App\Models\Citizen;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class AvtosImportNoHead implements ToModel
{
    
    // use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Avto([
            'id_citisen'=> $row[1],
            'brand_avto'    => $row[2], 
            'regis_num' => $row[3], 
            'color' => $row[4],
            'addit_inf' => $row[5],
            'who_noticed' => $row[6],
            'where_notice' => $row[7],
            // 'detection_time' =>Date::excelToDateTimeObject($row[8]),
            'detection_time' =>($row[8]),
            'id_user' =>$row[9],
            'user' =>$row[10],
        ]);
        
    }
}
