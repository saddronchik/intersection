<?php

namespace App\Imports;

use App\Models\Avto;
use App\Models\Border;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class BordersImport implements ToCollection
//ToModel, WithHeadingRow
{
    
    
 
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function collection(Collection $rows)
    {
        foreach ($rows as $key  => $row) {
            if ($key == 0) {
                continue;
            }
            Border::create([
                'id_citisen'=> $row[1],
                'citizenship'    => $row[2], 
                'full_name' => $row[3], 
                // 'date_birth' => Date::excelToDateTimeObject($row[4]),
                'date_birth' => ($row[4]),
                'passport' => $row[5],
                // 'crossing_date' => Date::excelToDateTimeObject($row[6]),
                'crossing_date' => ($row[6]),
                'crossing_time' =>($row[7]),
                'way_crossing' => $row[8],
                'checkpoint' => $row[9],
                'route' => $row[10],
                'place_birth' => $row[11],
                'place_regis' => $row[12],
            ]);
           
        }
    }
}
