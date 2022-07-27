<?php

namespace App\Http\Controllers;

use App\Exports\BordersExport;
use App\Imports\BordersImport;
use App\Imports\BordersImportNoHead;
use App\Models\Border;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BorderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borders = DB::table('borders')
        ->join('citizens','citizens.id','=','borders.id_citisen')
        ->join('avtos','avtos.id','=','borders.way_crossing')
        ->select('borders.id','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route','borders.id_user')
        ->paginate(5);
        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;

            return view('border',[
                "borders"=>$borders,
                "authUser"=>$authUser,
                "authUsername"=>$authUsername,
                ]);
    }
    public function indexUser()
    {
        $id_user = Auth::user()->id;
        $borders = DB::table('borders')
        ->join('records', 'records.id_border','=','borders.id')
        ->join('users', 'records.id_user','=','users.id')
        ->join('citizens','citizens.id','=','borders.id_citisen')
        ->join('avtos','avtos.id','=','borders.way_crossing')
        ->select('borders.id','records.id_user','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route')
        ->where('records.id_user','=', $id_user)
        ->get();
            return view('borderUser',[
                'borders'=>$borders,
                'id_user'=>$id_user
                ]);
    }

    public function indexa()
    {
        $borders = DB::table('citizens')

        ->select('citizens.id','citizens.full_name')
        ->get();
        $avtos = DB::table('avtos')

        ->select('avtos.id','avtos.brand_avto')
        ->get();

        $users = DB::table('users')
        ->select('users.id','users.username')
        ->get();

            return view('addborder',[
                "borders"=>$borders,
                "avtos"=>$avtos,
                "users"=>$users
]);

    }

 
    public function indexAdd(){
        return view('addborder');
    }

    public function searchBorders(Request $request){
        $s = $request->s;
        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;
        $borders = DB::table('borders')
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

            return view('border',[
                "borders"=>$borders,
                "authUser"=>$authUser,
                "authUsername"=>$authUsername
                ]);
    }
    public function searchBordersUser(Request $request){
        $s = $request->s;

        if (is_null($s)) {
            $id_user = Auth::user()->id;
            $borders = DB::table('borders')
                ->join('records', 'records.id_border','=','borders.id')
                ->join('users', 'records.id_user','=','users.id')
                ->join('citizens','citizens.id','=','borders.id_citisen')
                ->join('avtos','avtos.id','=','borders.way_crossing')
                ->select('borders.id','records.id_user','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route')
                ->where('records.id_user','=', $id_user)
                ->get();

            return view('borderUser',[
                'borders'=>$borders,
                'id_user'=>$id_user
            ]);
        }
        $id_user = Auth::user()->id;
        $borders = DB::table('borders')
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

            return view('borderUser',[
                'borders'=>$borders,
                'id_user'=>$id_user
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params =  $request->only(['id_citisen','citizenship','full_name','date_birth','passport','crossing_date','crossing_time','way_crossing','checkpoint','route','place_birth','place_regis','user','id_user']);
        $params['user']= Auth::user()->username;
        $params['id_user']= Auth::user()->id;
       
        $border = Border::create($params);
      
        $border->save();

        $id_border = $border ->id;
          
        foreach ($request->user as $user) {
           $records = Record::create([
               "id_user"=>$user,
               "id_border"=>$id_border
           ]);
       }
        return redirect('borderslist');
    }
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $border =  Border::find($id);
        $users = DB::table('users')
            ->select('users.id','users.username')
            ->get();
        return view('showBorder',["users"=>$users],compact('border'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params =  $request->only(['id','id_citisen','citizenship','full_name','date_birth','passport','crossing_date','crossing_time','way_crossing','checkpoint','route','place_birth','place_regis']);
        $border = Border::find($params['id']);

        $border->id_citisen = $params['id_citisen'];
        $border->citizenship = $params['citizenship'];
        $border->full_name = $params['full_name'];
        $border->date_birth = $params['date_birth'];
        $border->passport = $params['passport'];
        $border->crossing_date = $params['crossing_date'];
        $border->crossing_time = $params['crossing_time'];
        $border->way_crossing = $params['way_crossing'];
        $border->checkpoint = $params['checkpoint'];
        $border->route = $params['route'];
        $border->place_birth = $params['place_birth'];
        $border->place_regis = $params['place_regis'];

        $id_border = $border ->id;

           $delete = DB::table('records')->where('id_border',$id_border)->delete(); 
          if (is_null($request->user)){
            return $border->save();
          }
                foreach ($request->user as $user) {
       
                $records = Record::create([
                "id_user"=>$user,
                "id_border"=>$id_border
                ]);}

        return $border->save();
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Border::destroy($id);
        return redirect('borderslist');
    }
}
