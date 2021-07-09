<?php

namespace App\Http\Controllers;

use App\Models\Border;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;

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
        ->select('borders.id','citizens.full_name', 'borders.citizenship', 'borders.date_birth', 'borders.passport', 'borders.crossing_date', 'avtos.brand_avto','borders.checkpoint','borders.route')
        ->get();

            return view('border',[
                "borders"=>$borders
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

            return view('addborder',[
                "borders"=>$borders,
                "avtos"=>$avtos
]);

    }

 
    public function indexAdd(){
        return view('addborder');
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
        // dd($request);
        
        $params =  $request->only(['id_citisen','citizenship','full_name','date_birth','passport','crossing_date','crossing_time','way_crossing','checkpoint','route','place_birth','place_regis']);
        $border = Border::create($params);
        // $border = $request->validated();
        $border->save();
        return redirect('borderslist');
       
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
        return view('showBorder',compact('border'));


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
        $border->passport = $params['passport'];
        $border->crossing_date = $params['crossing_date'];
        $border->crossing_time = $params['crossing_time'];
        $border->way_crossing = $params['way_crossing'];
        $border->checkpoint = $params['checkpoint'];
        $border->route = $params['route'];
        $border->place_birth = $params['place_birth'];
        $border->place_regis = $params['place_regis'];
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
