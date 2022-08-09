<?php 

namespace App\Repositories;

use App\Models\Avto;
use App\Repositories\Interfaces\AvtosInterface;
use Illuminate\Http\Request;
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

    public function indexAvtosJoinRecordsUsers($id_user) {
       $result = DB::table('avtos')
        ->join('records', 'records.id_avto','=','avtos.id')
        ->join('users', 'records.id_user','=','users.id')
        ->select('avtos.id','avtos.id_citisen', 'avtos.brand_avto', 'avtos.addit_inf', 'avtos.regis_num', 'avtos.color','avtos.who_noticed','avtos.where_notice','avtos.detection_time','avtos.user')
        ->where('records.id_user','=', $id_user)
        ->get();

        return $result;
    }

    public function serchAvtos($s): LengthAwarePaginator {
        $result = DB::table('avtos')
            ->select('avtos.id','avtos.brand_avto','avtos.id_citisen', 'avtos.addit_inf', 'avtos.regis_num', 'avtos.color','avtos.who_noticed','avtos.where_notice','avtos.detection_time','avtos.user', 'avtos.id_user')        
            ->where('avtos.id_citisen','LIKE',"%{$s}%")
            ->orWhere('avtos.id','LIKE',"%{$s}%")
            ->orWhere('avtos.regis_num','LIKE',"%{$s}%")
            ->orWhere('avtos.brand_avto','LIKE',"%{$s}%")
            ->orWhere('avtos.color','LIKE',"%{$s}%")
            ->orWhere('avtos.user','LIKE',"%{$s}%")
            ->paginate(5);

        return $result;
    }

    public function serchAvtosJoinRecordsUsers($s,$id_user) {
        $result = DB::table('avtos')
            ->join('records', 'records.id_avto','=','avtos.id')
            ->join('users', 'records.id_user','=','users.id')
            ->select('avtos.id','records.id_user', 'avtos.brand_avto','avtos.id_citisen', 'avtos.addit_inf', 'avtos.regis_num', 'avtos.color','avtos.who_noticed','avtos.where_notice','avtos.detection_time','avtos.user')
            ->where('records.id_user','=', $id_user)
            ->where('avtos.id_citisen','LIKE',"%{$s}%")
            ->orWhere('avtos.brand_avto','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('avtos.id','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('avtos.user','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('avtos.who_noticed','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('avtos.where_notice','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('avtos.detection_time','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->get();
        return $result;
    }

    public function getBorderAvtos($id){
      $result = Avto::join('borders','avtos.id','=','borders.way_crossing')
        ->select('avtos.id','avtos.brand_avto','avtos.regis_num','borders.full_name','borders.passport','borders.crossing_date','borders.checkpoint')
        ->where('borders.way_crossing','=',$id)
        ->get();

      return $result;
    }



}
