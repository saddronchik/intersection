<?php 

namespace App\Repositories;

use App\Models\Citizen;
use App\Repositories\Interfaces\CitisensInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitisensRepository implements CitisensInterface
{
    public function getAll(): LengthAwarePaginator
    {
        $result = DB::table('citizens')
            ->paginate(5);
        return $result;
    }

    public function getCizensJoinRecordsUsers() {
        $id_user = Auth::user()->id;
        $result = DB::table('citizens')
            ->join('records', 'records.id_citisen','=','citizens.id')
            ->join('users', 'records.id_user','=','users.id')
            ->select('citizens.id','records.id_user','citizens.full_name','citizens.passport_data','citizens.date_birth','citizens.who_noticed','citizens.where_notice','citizens.detection_time','citizens.user')
            ->where('records.id_user','=', $id_user)
            ->get();
        
        return $result;
    }

    public function getSearchCitisens(Request $request): LengthAwarePaginator {
        $s = $request->s;
        $result = Citizen::query()->where('full_name','LIKE',"%{$s}%")
            ->orWhere('passport_data','LIKE',"%{$s}%")
            ->orWhere('id','LIKE',"%{$s}%")
            ->orderBy('full_name')
            ->paginate(5);

        return $result;
    }

    public function getSearchUsersNullInCitisens(Request $request)  {
        $s = $request->s;
        $id_user = Auth::user()->id;
        $result = DB::table('citizens')
            ->join('records', 'records.id_citisen','=','citizens.id')
            ->join('users', 'records.id_user','=','users.id')
            ->select('citizens.id','records.id_user','citizens.full_name','citizens.passport_data','citizens.date_birth','citizens.who_noticed','citizens.where_notice','citizens.detection_time','citizens.user')
            ->where('records.id_user','=', $id_user)
            ->get();

        return $result;
    }

    public function getSearchUsersInCitisens(Request $request) {
        $s = $request->s;
        $id_user = Auth::user()->id;
        $result = DB::table('citizens')
            ->join('records', 'records.id_citisen','=','citizens.id')
            ->join('users', 'records.id_user','=','users.id')
            ->select('citizens.id','records.id_user','citizens.full_name','citizens.passport_data','citizens.date_birth','citizens.who_noticed','citizens.where_notice','citizens.detection_time','citizens.user')
            ->where('records.id_user','=', $id_user)
            ->where('citizens.full_name','LIKE',"%{$s}%")
            ->orWhere('citizens.id','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->orWhere('citizens.user','LIKE',"%{$s}%")
            ->where('records.id_user','=', $id_user)
            ->get();

        return $result;
    }

    public function getUsers(){
        $result = DB::table('users')
            ->select('users.id','users.username')
            ->get();

        return $result;
    }

    public function getShowMessages($id){
       $result = DB::table('messages')
            ->select('messages.id','messages.from_user','messages.message','messages.created_at')
            ->where('messages.to_user','=',$id)
            ->orderByDesc('messages.created_at')
            ->get();

        return $result;
    }

    public function getBorderCitisens($id){

        $request = DB::table('citizens')
            ->join('borders','borders.id_citisen','=','citizens.id')
            ->select('citizens.id','citizens.full_name', 'citizens.passport_data', 'borders.crossing_date','borders.crossing_time','borders.checkpoint','borders.route')
            ->where('borders.id_citisen','=',$id)
            ->get();

        return $request;
    }

}