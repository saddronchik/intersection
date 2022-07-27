<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Exports\CitisenExport;
use App\Exports\CitisensExport;
use App\Imports\CitisensImport;
use App\Imports\CitisenImportNoHead;
use App\Imports\CitisensImportNoHead;
use App\Models\Message;
use App\Models\Record;
use App\Models\User;
use App\Models\Border;
use App\Repositories\CitisensRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\VarDumper\Cloner\Data;

class CitisenControl extends Controller
{
    private $citisensRepository;

    public function __construct(CitisensRepository $citisensRepository)
    {
        $this->middleware('auth');
        $this->citisensRepository = $citisensRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
        ->select('users.id','users.username')
        ->get();
        return view('addcitisens',["users"=>$users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addcitisens');
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
            $path = $request->file('photo')->store('folder');
        }else {
            $path = null;
        }
            $params = $request->all();
            $params['photo']=$path;
            $params['user']= Auth::user()->username;
            $params['id_user']= Auth::user()->id;
            
           if( $request['social_account1']==null){
            $params['social_account'] = $request['social_account'];
           }elseif($request['social_account2']==null){
            $params['social_account'] = $request['social_account'] ; 
            $params['social_account1'] = $request['social_account1'];
           }elseif ($request['social_account3']==null) {
            $params['social_account'] = $request['social_account']; 
            $params['social_account1'] = $request['social_account1']; 
            $params['social_account2'] = $request['social_account2'];
           }elseif ($request['social_account4']==null) {
            $params['social_account'] = $request['social_account']; 
            $params['social_account1'] = $request['social_account1'];
            $params['social_account2'] =  $request['social_account2']; 
            $params['social_account3'] = $request['social_account3'];
           }else {
            $params['social_account'] = $request['social_account']; 
            $params['social_account1'] = $request['social_account1']; 
            $params['social_account2'] = $request['social_account2']; 
            $params['social_account3'] = $request['social_account3']; 
            $params['social_account4'] = $request['social_account4'];
           }

           if ($request['phone_number1']==null) {
            $params['phone_number'] = $request['phone_number'];
           }elseif ($request['phone_number2']== null) {
            $params['phone_number'] = $request['phone_number']; 
            $params['phone_number1'] = $request['phone_number1'];
           }else{
            $params['phone_number'] = $request['phone_number']; 
            $params['phone_number1'] = $request['phone_number1']; 
            $params['phone_number2'] = $request['phone_number2'];
           }

           if ($request['passport_data1'] == null) {
            $params['passport_data'] = $request['passport_data'];
           }elseif ($request['passport_data2']) {
            $params['passport_data'] = $request['passport_data']; 
            $params['passport_data1'] = $request['passport_data1'];
           }else {
            $params['passport_data'] = $request['passport_data']; 
            $params['passport_data1'] = $request['passport_data1']; 
            $params['passport_data2'] = $request['passport_data2'];
           }
            $citizen = Citizen::create($params);
            $citizen->save();
        
           $id_citisen = $citizen ->id;
          
         foreach ($request->user as $user) {
            $records = Record::create([
                "id_user"=>$user,
                "id_citisen"=>$id_citisen
            ]);
        }
           return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $citizen = Citizen::find($id);
        $users = $this->citisensRepository->getUsersId();
        
        return view('showCitisen',["users"=>$users],compact('citizen')); 
    }

    public function sendMessage(Request $request){
        date_default_timezone_set("Europe/Moscow");
        $params = $request->all();
        $params['created_at'] = date('Y-m-d H:i:s');
        $message = Message::create([
            'from_user'=>$params['from'],
            'to_user'=>$params['to'],
            'message'=>$params['message'],
        ]);
     
            return response()->json($params);
         }

    public function showmessages($id){
        $messages = $this->citisensRepository->getShowMessages($id);

        return response()->json(["messages" => $messages,]);
    }

    public function viewMessages(){
        $authUser = Auth::user();

        return view('citisens_message',["authUser"=>$authUser]);
    }

    public function showBorderCitisen($id){
        $citisens = $this->citisensRepository->getBorderCitisens($id);

        return view('citisens_border',["citisens"=>$citisens]);
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

    public function CitisenExport(){
        return Excel::download(new CitisensExport, 'citisen.xlsx');
    }
    
    public function CitisenImport(Request $request){
        if ($request['haveHead'] == true) {
            Excel::import(new  CitisensImport, $request->file('files'));
        
            return back()->withStatus('Успешно импортировано c шапкой!');

        } elseif ($request['haveHead'] == null) {
            Excel::import(new CitisensImportNoHead, $request->file('files'));
        
            return back()->withStatus('Успешно импортировано без шапки!');
        }
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citizen $citizen)
    {   
        $params = $request->all(); 
        $citizen = Citizen::find($params['id']);
        if ($request->photo==null) {
            
            $params = $request->all(); 
            $citizen = Citizen::find($params['id']);
            $citizen->passport_data = $params["passport_data"];
            $citizen->passport_data1 = $params["passport_data1"];
            $citizen->passport_data2 = $params["passport_data2"];
            $citizen->date_birth = $params["date_birth"];
            $citizen->place_registration = $params["place_registration"];
            $citizen->place_residence = $params["place_residence"];
            $citizen->phone_number = $params["phone_number"];

            $citizen->phone_number1 = $params["phone_number1"];
            $citizen->phone_number2 = $params["phone_number2"];
            $citizen->social_account = $params["social_account"];
            $citizen->social_account1 = $params["social_account1"];
            $citizen->social_account2 = $params["social_account2"];
            $citizen->social_account3 = $params["social_account3"];
            $citizen->social_account4 = $params["social_account4"];
            $citizen->who_noticed = $params["who_noticed"];
            $citizen->where_notice = $params["where_notice"];
            $citizen->detection_time = $params["detection_time"];
            
            $citizen->addit_inf = $params["addit_inf"];

            $id_citisen = $citizen ->id;

           $delete = DB::table('records')->where('id_citisen',$id_citisen)->delete(); 
          if (is_null($request->user)){
            return $citizen->save();
          }
            foreach ($request->user as $user) {
                $records = Record::create([
                "id_user"=>$user,
                "id_citisen"=>$id_citisen]);
            }
                $records->save();
            return $citizen->save() ;
        }else {
           
       Storage::delete($citizen->photo);
        
        $path = $request->file('photo')->store('folder');
     
        $params['photo']=$path;
       
        $citizen->passport_data = $params["passport_data"];
        $citizen->date_birth = $params["date_birth"];
        $citizen->place_registration = $params["place_registration"];
        $citizen->place_residence = $params["place_residence"];
        $citizen->phone_number = $params["phone_number"];
        $citizen->social_account = $params["social_account"];
        $citizen->photo = $params["photo"];
        $citizen->who_noticed = $params["who_noticed"];
        $citizen->where_notice = $params["where_notice"];
        $citizen->detection_time = $params["detection_time"];
        $id_citisen = $citizen ->id;

        $delete = DB::table('records')->where('id_citisen',$id_citisen)->delete(); 
       if (is_null($request->user)){
         return $citizen->save();
       }
             foreach ($request->user as $user) {
    
             $records = Record::create([
                "id_user"=>$user,
                "id_citisen"=>$id_citisen]);
            }
        
        return $citizen->save();
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
        Border::where('id_citisen','=',$id)->delete();
        Citizen::destroy($id);
        return redirect()->route('home');   
    }

    public function destroyMessage($id){
        Message::destroy($id);

    }
}
