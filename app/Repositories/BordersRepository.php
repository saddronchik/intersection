<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BordersInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use LengthException;

class BordersRepository implements BordersInterface {
    

    public function indexBorder():LengthAwarePaginator {

        $result = DB::table('borders')
            ->join('citizens','citizens.id','=','borders.id_citisen')
            ->join('avtos','avtos.id','=','borders.way_crossing')
            ->select('borders.id','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route','borders.id_user')
            ->paginate(5);

        return $result;
    }

    public function indexBorderUser($id_user){
    $result = DB::table('borders')
        ->join('records', 'records.id_border','=','borders.id')
        ->join('users', 'records.id_user','=','users.id')
        ->join('citizens','citizens.id','=','borders.id_citisen')
        ->join('avtos','avtos.id','=','borders.way_crossing')
        ->select('borders.id','records.id_user','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route')
        ->where('records.id_user','=', $id_user)
        ->get();
        return $result;
    }

    public function serchBorder($s):LengthAwarePaginator {

       $result = DB::table('borders')
        ->join('citizens','citizens.id','=','borders.id_citisen')
        ->join('avtos','avtos.id','=','borders.way_crossing')
        ->select('borders.id','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route','borders.id_user')
        ->where('citizens.full_name','LIKE',"%{$s}%")
        ->orWhere('avtos.brand_avto','LIKE',"%{$s}%")
        ->orWhere('borders.id','LIKE',"%{$s}%")
        ->orWhere('borders.citizenship','LIKE',"%{$s}%")
        ->orWhere('borders.passport','LIKE',"%{$s}%")
        ->orWhere('avtos.regis_num','LIKE',"%{$s}%")
        ->paginate(5);

        return $result;
    }

    public function serchBorderUserNull($id_user){

        $result = DB::table('borders')
            ->join('records', 'records.id_border','=','borders.id')
            ->join('users', 'records.id_user','=','users.id')
            ->join('citizens','citizens.id','=','borders.id_citisen')
            ->join('avtos','avtos.id','=','borders.way_crossing')
            ->select('borders.id','records.id_user','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route')
            ->where('records.id_user','=', $id_user)
            ->get();

        return $result;

    }

    public function serchBorderUser($id_user,$s){
        $result = DB::table('borders')
            ->join('records', 'records.id_border','=','borders.id')
            ->join('users', 'records.id_user','=','users.id')
            ->join('citizens','citizens.id','=','borders.id_citisen')
            ->join('avtos','avtos.id','=','borders.way_crossing')
            ->select('borders.id','records.id_user','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route')
            ->where('records.id_user','=', $id_user)
            ->where('citizens.full_name','LIKE',"%{$s}%")
            ->orWhere('avtos.brand_avto','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('borders.id','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('borders.citizenship','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('borders.passport','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('avtos.regis_num','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->get();
        return $result;
    }


}