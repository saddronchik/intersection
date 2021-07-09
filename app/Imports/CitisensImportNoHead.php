<?php

namespace App\Imports;

use App\Models\Citizen;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class CitisensImportNoHead implements ToModel
{
    
 
    // use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Citizen([
            'full_name'=> $row[1],
            'passport_data'    => $row[2], 
            'date_birth' => Date::excelToDateTimeObject($row[3]) , 
            'place_residence' => $row[4],
            'phone_number' => $row[5],
            'social_account' => $row[6],
            'addit_inf' => $row[7],
        ]);
        
    }
}
