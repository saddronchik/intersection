<?php

namespace App\Imports;

use App\Models\Citizen;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class CitisensImport implements ToModel, WithHeadingRow
{
    
    
 
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        
        return new Citizen([
            'full_name'=> $row['polnoe_imya'],
            'passport_data'    => $row['passport'], 
            'date_birth' => Date::excelToDateTimeObject($row['data_rozdeniya']) , 
            'place_residence' => $row['mesto_rozdeniya'],
            'phone_number' => $row['telefonnyi_nomer'],
            'social_account' => $row['socialnyi_akkaunt'],
            'addit_inf' => $row['dopolnitelnaya_informaciya'],
        ]);
        
    }
}
