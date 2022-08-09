<?php

namespace App\Repositories;

use App\Models\Peoples;
use App\Repositories\Interfaces\PeoplesInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class PeoplesRepository implements PeoplesInterface
{

    public function getSearchPeoples(Request $request): LengthAwarePaginator {
        $s = $request->s;
        $result = Peoples::query()->where('full_name','LIKE',"%{$s}%")
            ->orWhere('passport_data','LIKE',"%{$s}%")
            ->orWhere('id','LIKE',"%{$s}%")
            ->orderBy('full_name')
            ->paginate(5);

        return $result;
    }

    public function getSearchUsersNullInPeoples(Request $request)  {
        $s = $request->s;
        $id_user = Auth::user()->id;
        $result = DB::table('peoples')
            ->join('records', 'records.id_people','=','peoples.id')
            ->join('users', 'records.id_user','=','users.id')
            ->select('peoples.id','records.id_user','peoples.full_name','peoples.passport_data','peoples.date_birth','peoples.id_user','peoples.user')
            ->where('records.id_user','=', $id_user)
            ->get();

        return $result;
    }

    public function getSearchUsersInPeoples(Request $request) {
        $s = $request->s;
        $id_user = Auth::user()->id;
        $result = DB::table('peoples')
            ->join('records', 'records.id_people','=','peoples.id')
            ->join('users', 'records.id_user','=','users.id')
            ->select('peoples.id','records.id_user','peoples.full_name','peoples.passport_data','peoples.date_birth','peoples.id_user','peoples.user')
            ->where('records.id_user','=', $id_user)
            ->where('peoples.full_name','LIKE',"%{$s}%")
            ->orWhere('peoples.id','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('peoples.user','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->get();

        return $result;
    }

    public function getPeoplesJoinRecordsUsers(){
        $id_user = Auth::user()->id;
        $result = DB::table('peoples')
            ->join('records', 'records.id_people','=','peoples.id')
            ->join('users', 'records.id_user','=','users.id')
            ->select('peoples.id','records.id_user','peoples.full_name','peoples.passport_data','peoples.date_birth','peoples.id_user','peoples.user')
            ->where('records.id_user','=', $id_user)
            ->get();
        
        return $result;
    }

}