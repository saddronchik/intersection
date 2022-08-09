<?php

namespace App\Http\Controllers;

use App\Exports\BordersExport;
use App\Http\Requests\BorderCreateRequest;
use App\Imports\BordersImport;
use App\Imports\BordersImportNoHead;
use App\Models\Avto;
use App\Models\Border;
use App\Models\Citizen;
use App\Models\Record;
use App\Models\User;
use App\Repositories\BordersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BorderController extends Controller
{
    private $borderRepository;

    public function __construct(BordersRepository $borderRepository)
    {
        $this->borderRepository = $borderRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borders = $this->borderRepository->indexBorder();
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
        $borders = $this->borderRepository->indexBorderUser($id_user);
            return view('borderUser',[
                'borders'=>$borders,
                'id_user'=>$id_user
                ]);
    }

    public function indexa()
    {
        $borders = Citizen::select('citizens.id','citizens.full_name')->get();

        $avtos = Avto::select('avtos.id','avtos.brand_avto')->get();

        $users = User::select('users.id','users.username')->get();
            return view('addborder',[
                "borders"=>$borders,
                "avtos"=>$avtos,
                "users"=>$users]);

    }

    public function indexAdd(){
        return view('addborder');
    }

    public function searchBorders(Request $request){
        
        $s = $request->s;
        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;
        $borders = $this->borderRepository->serchBorder($s);
        
            return view('border',[
                "borders"=>$borders,
                "authUser"=>$authUser,
                "authUsername"=>$authUsername
            ]);
    }

    public function searchBordersUser(Request $request){
        $s = $request->s;
        $id_user = Auth::user()->id;
        if (is_null($s)) {
            
            $borders = $this->borderRepository->serchBorderUserNull($id_user);
            return view('borderUser',[
                'borders'=>$borders,
                'id_user'=>$id_user
            ]);
        }
       
        $borders = $this->borderRepository->serchBorderUser($id_user,$s);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BorderCreateRequest $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $border =  Border::find($id);
        $users = User::select('users.id','users.username')->get();

        return view('showBorder',["users"=>$users,"border"=>$border]);
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
    public function update(BorderCreateRequest $request)
    {

        $params = $request->all();
        $border = Border::find($params['id']);
        $params['user']= $border['user'];
        $border->fill($params)->save();

        $id_border = $border ->id;

        Record::where('id_border',$id_border)->delete(); 
      
            foreach ($request->user as $user) {
                $records = Record::create([
                "id_user"=>$user,
                "id_border"=>$id_border
                ]);}
        // $border->save();
        return redirect('borderslist');
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
