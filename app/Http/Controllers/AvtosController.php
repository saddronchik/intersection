<?php

namespace App\Http\Controllers;

use App\Models\Avto;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvtosController extends Controller
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
        
            $avtos = DB::table('avtos')
                    ->join('citizens','citizens.id','=','avtos.id_citisen')
                    ->select('avtos.id', 'avtos.brand_avto', 'avtos.addit_inf', 'avtos.regis_num', 'avtos.color', 'citizens.full_name')
                    ->get();

            return view('avto',[
                "avtos"=>$avtos
            ]);
        
    }


    public function indexAdd(){
        $citisens = DB::table('citizens')

        ->select('citizens.id','citizens.full_name')
        ->get();


            return view('addavtos',[
                "citisens"=>$citisens,
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
        // try{
            if ( $path = $request->file('photo')) {
                $path = $request->file('photo')->store('avtos');
            }else {
                $path = null;
            }
            
        
                $params = $request->only(['id_citisen','brand_avto','regis_num','color','photo','addit_inf']);
    
           
                $params['photo']=$path;
    
                $avto = Avto::create($params);
                $avto->save();
                return redirect('avtoslist');
        // }catch (Exception $e) {
        //         echo 'Ошибака';
        //             redirect()->back()
        //                 ->with('error',$e->getMessage());
        //          }
           
            
            // 
            
            
        
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
        return view('showAvto',compact('avto'));
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
        $params = $request->only(['id','id_citisen','brand_avto','regis_num','color','photo','addit_inf']); 
        $avto = Avto::find($params['id']);
        if ( $path = $request->file('photo')) {
            $path = $request->file('photo')->store('avtos');
        }else {
            $path = null;
        }
        $params['photo']=$path;
       
        $avto->id_citisen = $params["id_citisen"];
        $avto->brand_avto = $params["brand_avto"];
        $avto->regis_num = $params["regis_num"];
        $avto->color = $params["color"];
        // $avto->photo = $params["photo"];
        $avto->addit_inf = $params["addit_inf"];
        return $avto->save();
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
