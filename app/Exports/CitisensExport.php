<?php

namespace App\Exports;

use App\Models\Citizen;
// use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class CitisensExport implements FromView,WithColumnFormatting,WithMapping
/**
    * @return \Illuminate\Support\Collection
   */
{
    public function view(): View
    {
        // $citisen = Citizen::all();
        $citisen = DB::table('citizens')
                    ->select('citizens.id','citizens.full_name','citizens.passport_data','citizens.passport_data1','citizens.passport_data2','citizens.date_birth','citizens.photo','citizens.place_registration','citizens.place_residence','citizens.phone_number','citizens.phone_number1','citizens.phone_number2','citizens.social_account','citizens.social_account1','citizens.social_account2','citizens.social_account3','citizens.social_account4','citizens.addit_inf','citizens.who_noticed','citizens.where_notice','citizens.detection_time','citizens.user','citizens.id_user')
                    ->get();
        
        
        return view('export.citisens', [
            'citisens' => $citisen
        ]);
    }

    public function map($invoice): array
    {
       
        return [
            $invoice->invoice_number,
            Date::dateTimeToExcel($invoice->created_at),
            $invoice->total
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'T' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}

