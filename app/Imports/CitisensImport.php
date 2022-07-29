<?php

namespace App\Imports;

use App\Models\Citizen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class CitisensImport implements ToCollection
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
            Citizen::create([
                'full_name'=> $row[1],
                'passport_data'    => $row[2], 
                'passport_data1'    => $row[3], 
                'passport_data2'    => $row[4], 
                'date_birth' => ($row[5]) , 
                // 'date_birth' => Date::excelToDateTimeObject($row[5]) , 
                'place_registration' => $row[6],
                'place_residence' => $row[7],
                'phone_number' => $row[8],
                'phone_number1' => $row[9],
                'phone_number2' => $row[10],
                'social_account' => $row[11],
                'social_account1' => $row[12],
                'social_account2' => $row[13],
                'social_account3' => $row[14],
                'social_account4' => $row[15],
                'addit_inf' => $row[16],
                'who_noticed' => $row[17],
                'where_notice' => $row[18],
                // 'detection_time' => Date::excelToDateTimeObject($row[19]),
                'detection_time' => ($row[19]),
                'id_user' => $row[20],
                'user' => $row[21],
            ]);
        }
    }
}
