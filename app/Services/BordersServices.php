<?php 

namespace App\Services;

use App\Exports\BordersExport;
use App\Imports\BordersImport;
use App\Imports\BordersImportNoHead;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BordersServices{

    public function BordersExport(){
        return Excel::download(new BordersExport, 'borders.xlsx');
    }

    public function BordersImport(Request $request){

        if ($request['haveHead'] == true) {
            Excel::import(new  BordersImport, $request->file('files'));
        
            return back()->withStatus('Успешно импортировано c шапкой!');
        } elseif ($request['haveHead'] == null) {
            Excel::import(new BordersImportNoHead, $request->file('files'));
        
            return back()->withStatus('Успешно импортировано без шапки!');
        }
    }
}