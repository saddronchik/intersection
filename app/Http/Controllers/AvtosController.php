<?php

namespace App\Http\Controllers;

use App\Exports\AvtosExport;
use App\Imports\AvtosImport;
use App\Imports\AvtosImportNoHead;
use App\Models\Avto;
use App\Models\Record;
use App\Repositories\AvtosRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AvtosController extends Controller
{
    private $avtosRepository;

    public function __construct(AvtosRepository $avtosRepository)
    { 
        $this->middleware('auth');

        $this->avtosRepository = $avtosRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avtos = $this->avtosRepository->indexAvtos();

        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;

        return view('avto',[
            "avtos"=>$avtos,
            "authUser"=>$authUser,
            "authUsername"=>$authUsername
        ]);
        
    }
    public function indexavto(){
        $id_user = Auth::user()->id;
        $avtos =  $this->avtosRepository->indexAvtosJoinRecordsUsers($id_user);

        return view('avtoUser', [
            'avtos'=>$avtos,
            'id_user'=>$id_user
        ]);
    }


    public function indexAdd(){
        $citisens = DB::table('citizens')
            ->select('citizens.id','citizens.full_name')
            ->get();
        $users = DB::table('users')
            ->select('users.id','users.username')
            ->get();
        
        return view('addavtos',[
            "citisens"=>$citisens,
            "users"=>$users
        ]);
       
    }

    public function searchAvto(Request $request){
        $s = $request->s;
        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;
        $avtos = $this->avtosRepository->serchAvtos($s);
        
        return view('avto', [
            "avtos"=>$avtos,
            "authUser"=>$authUser,
            "authUsername"=>$authUsername,
        ]);
    }

    public function searchAvtoUser(Request $request){
        $s = $request->s;
        if (is_null($s)) {
            $id_user = Auth::user()->id;
            $avtos =  $this->avtosRepository->indexAvtosJoinRecordsUsers($id_user);
            
            return view('avtoUser', [
                'avtos'=>$avtos,
                'id_user'=>$id_user
            ]);
        }
        $id_user = Auth::user()->id;
        $avtos =  $this->avtosRepository->serchAvtosJoinRecordsUsers($s,$id_user);

        return view('avtoUser', [
            'avtos'=>$avtos,
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
            if ( $path = $request->file('photo')) {
                $path = $request->file('photo')->store('avtos');
            }else {
                $path = null;
            }
                $params = $request->only(['id_citisen','brand_avto','regis_num','color','photo','addit_inf','who_noticed','where_notice','detection_time','user','id_user']);
                $params['photo']=$path;
                $params['user']= Auth::user()->username;
                $params['id_user']= Auth:: user()->id;
    
                $avto = Avto::create($params);
                $avto->save();
                $id_avto = $avto ->id;
          
            foreach ($request->user as $user) {
                $records = Record::create([
                    "id_user"=>$user,
                    "id_avto"=>$id_avto
                   ]);
               }

            return redirect('avtoslist');
 
    }
    
    public function showBorderAvtos($id){
        $avtos = DB::table('avtos')
                ->join('borders','avtos.id','=','borders.way_crossing')
                ->select('avtos.id','avtos.brand_avto','avtos.regis_num','borders.full_name','borders.passport','borders.crossing_date','borders.checkpoint')
                ->where('borders.way_crossing','=',$id)
                ->get();

        return view('avtos_border',["avtos"=>$avtos]);
        
    }



    public function AvtosExport(){
        return Excel::download(new AvtosExport, 'avtos.xlsx');
    }
    public function AvtosImport(Request $request){
        if ($request['haveHead'] == true) {
            Excel::import(new  AvtosImport, $request->file('files'));
        
            return back()->withStatus('Успешно импортировано c шапкой!');
        } elseif ($request['haveHead'] == null) {
            Excel::import(new AvtosImportNoHead, $request->file('files'));
        
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
        $avto = Avto::find($id);
        $users = DB::table('users')
            ->select('users.id','users.username')
            ->get();

        return view('showAvto',["users"=>$users], compact('avto'));
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

    public function update(Request $request, Avto $avto)
    {
        $params = $request->only(['id','id_citisen','brand_avto','regis_num','color','photo','addit_inf','who_noticed','where_notice','detection_time','user']); 
        $avto = Avto::find($params['id']);
        if ( $request->photo==null) {
            $avto->id_citisen = $params["id_citisen"];
            $avto->brand_avto = $params["brand_avto"];
            $avto->regis_num = $params["regis_num"];
            $avto->who_noticed = $params["who_noticed"];
            $avto->where_notice = $params["where_notice"];
            $avto->detection_time = $params["detection_time"];
            $avto->addit_inf = $params["addit_inf"];

            $id_avto = $avto ->id;

           $delete = DB::table('records')->where('id_avto',$id_avto)->delete(); 
          if (is_null($request->user)){
            return $avto->save();
          }
                foreach ($request->user as $user) {
                $records = Record::create([
                "id_user"=>$user,
                "id_avto"=>$id_avto
                ]);}

        return $avto->save();
        }else {
            Storage::delete($avto->photo);
        
            $path = $request->file('photo')->store('avtos');
            $params['photo']=$path;
            $avto->id_citisen = $params["id_citisen"];
            $avto->brand_avto = $params["brand_avto"];
            $avto->regis_num = $params["regis_num"];
            $avto->color = $params["color"];
            $avto->photo = $params["photo"];
            $avto->who_noticed = $params["who_noticed"];
            $avto->where_notice = $params["where_notice"];
            $avto->detection_time = $params["detection_time"];
            $avto->addit_inf = $params["addit_inf"];

        $id_avto = $avto ->id;
       if (is_null($request->user)){
         return $avto->save();
       }else {
        $delete = DB::table('records')->where('id_avto',$id_avto)->delete(); 
        foreach ($request->user as $user) {
        $records = Record::create([
        "id_user"=>$user,
        "id_avto"=>$id_avto
        ]);}
       }
       
        return $avto->save();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Avto::destroy($id);
        return redirect()->back();
    }
}
