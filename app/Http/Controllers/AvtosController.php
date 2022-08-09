<?php

namespace App\Http\Controllers;

use App\Exports\AvtosExport;
use App\Http\Requests\AvtoCreateRequest;
use App\Imports\AvtosImport;
use App\Imports\AvtosImportNoHead;
use App\Models\Avto;
use App\Models\Citizen;
use App\Models\Record;
use App\Models\User;
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

        $citisens = Citizen::select('citizens.id','citizens.full_name')->get();
        $users = User::select('users.id','users.username')->get();
        
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AvtoCreateRequest $request)
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
        $avtos = $this->avtosRepository->getBorderAvtos($id);

        return view('avtos_border',["avtos"=>$avtos]);
        
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
        $users = User::select('users.id','users.username')->get();

        return view('showAvto',["users"=>$users], compact('avto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(AvtoCreateRequest $request, Avto $avto)
    {
       
        $params = $request->all(); 
        $avto = Avto::find($params['id']);
        $params['user']= $avto['user'];
        if ( $request->photo==null) {
            $result = $avto->fill($params)->save();

            $id_avto = $avto ->id;
            
           Record::where('id_avto',$id_avto)->delete(); 
           
            foreach ($request->user as $user) {
            $records = Record::create([
            "id_user"=>$user,
            "id_avto"=>$id_avto
            ]);}
                $avto->save();
        return redirect()->route('avtoslist');
        }else {
            Storage::delete($avto->photo);
        
            $path = $request->file('photo')->store('avtos');
            $params['photo']=$path;
            $avto->fill($params)->save();

        $id_avto = $avto ->id;
       
        Record::where('id_avto',$id_avto)->delete(); 
        foreach ($request->user as $user) {
        $records = Record::create([
        "id_user"=>$user,
        "id_avto"=>$id_avto
        ]);}
        $avto->save();
        return redirect()->route('avtoslist');
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
