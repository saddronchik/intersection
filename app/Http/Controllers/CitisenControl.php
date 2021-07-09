<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Exports\CitisenExport;
use App\Exports\CitisensExport;
use App\Imports\CitisensImport;
use App\Imports\CitisenImportNoHead;
use App\Imports\CitisensImportNoHead;
use Maatwebsite\Excel\Facades\Excel;

class CitisenControl extends Controller
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
        return view('addcitisens');
    }
    // public function indexExport()
    //     {
    //         $citisens = Citizen::all();
    
    //         return view('export.citisens',[
    //             "citisens"=>$citisens
    //         ]);
    //     }
    

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
            $path = $request->file('photo')->store('folder');
        }else {
            $path = null;
        }
        
    
            $params = $request->only(['full_name','passport_data','photo','date_birth','place_residence','phone_number','social_account','addit_inf']);

          
            $params['photo']=$path;

            $citizen = Citizen::create($params);
  
       
        if ($citizen) {
           return redirect()->route('home');
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
        
      
        $citizen = Citizen::find($id);
        return view('showCitisen',compact('citizen'));
        
      
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
        // dd($request['haveHead']);

        if ($request['haveHead'] == true) {
            Excel::import(new  CitisensImport, $request->file('files'));
        
            return back()->withStatus('Успешно импортировано c шапкой!');
        } elseif ($request['haveHead'] == null) {
            Excel::import(new CitisensImportNoHead, $request->file('files'));
        
            return back()->withStatus('Успешно импортировано без шапки!');
        }
        // Excel::import(new  CitisensImport, $request->file('files'));
        
        // return back()->withStatus('Успешно импортировано c !');
        // // redirect('/home')
    }
    public function CitisenImportNoHead(Request $request){
        // Excel::import(new CitisensImportNoHead, $request->file('files'));
        
        // return back()->withStatus('Успешно импортировано!');
        // // redirect('/home')
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
       
        $params = $request->only(['id','full_name','passport_data','photo','date_birth','place_residence','phone_number','social_account','addit_inf']); 
        $citizen = Citizen::find($params['id']);
        if ( $path = $request->file('photo')) {
            $path = $request->file('photo')->store('folder');
        }else {
            $path = null;
        }
       

          
        $params['photo']=$path;
       
        $citizen->passport_data = $params["passport_data"];
        $citizen->date_birth = $params["date_birth"];
        $citizen->place_residence = $params["place_residence"];
        $citizen->phone_number = $params["phone_number"];
        $citizen->social_account = $params["social_account"];
        $citizen->addit_inf = $params["addit_inf"];
        return $citizen->save();

    
       
            # co
        // dd($params);

    //   return view('showCitisen',compact('citizen'));


      
        // return view('',compact('citizen'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Citizen::destroy($id);
        return redirect()->route('home');   
    }
}
