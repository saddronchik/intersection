<?php

namespace App\Services;

use App\Models\Peoples;
use App\Models\Record;

class PeoplesServices{

    

    public function remove($id){
        Record::where('id_people',$id)->delete();
        Peoples::destroy($id);
     
        return back()->withStatus('200');  
    }
}