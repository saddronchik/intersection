<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\AvtosInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AvtosRepository implements AvtosInterface
{

    public function indexAvtos(): LengthAwarePaginator{
       $result = DB::table('avtos')
            ->select('avtos.id','avtos.id_citisen', 'avtos.brand_avto', 'avtos.addit_inf', 'avtos.regis_num', 'avtos.color','avtos.who_noticed','avtos.where_notice','avtos.detection_time','avtos.user','avtos.id_user')
            ->paginate(5);
        
        return $result;
    }

}
