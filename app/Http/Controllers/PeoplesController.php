<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleCreateRequest;
use App\Models\Peoples;
use App\Models\Record;
use App\Models\User;
use App\Repositories\PeoplesRepository;
use App\Services\PeoplesServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDO;

class PeoplesController extends Controller
{   
    private $peoplesRepository;
    private $peoplesServices;


    public function __construct(PeoplesRepository $peoplesRepository, PeoplesServices $peoplesServices)
    {
        $this->middleware('auth');

        $this->peoplesRepository = $peoplesRepository;
        $this->peoplesServices = $peoplesServices;
    }
    
    public function index(){
        $peoples = Peoples::select('id','full_name','date_birth','id_user','user')->paginate(5);
        return view('peoplelist',["peoples"=>$peoples]);
    }

    public function indexUser(){
        $id_user = Auth::user()->id;
        $peoples = $this->peoplesRepository->getPeoplesJoinRecordsUsers() ;
        return view('peopleUser', [
            'peoples'=>$peoples,
            'id_user'=>$id_user
        ]);
    }

    public function searchPeople(Request $request){
        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;
        $peoples = $this->peoplesRepository->getSearchPeoples($request) ;
       
        return view('peoplelist',  [
            'peoples'=>$peoples,
            'authUser' => $authUser,
            'authUsername' => $authUsername, 
        ]);
    }

    public function searchPeopleUser(Request $request){
        $s = $request->s;
        if (is_null($s)) {
            $id_user = Auth::user()->id;
            $authUsername = Auth::user()->username;
            $peoples =  $this->peoplesRepository->getSearchUsersNullInPeoples($request);

            return view('peopleUser', [
                'peoples'=>$peoples,
                'id_user'=>$id_user,
                'authUsername' => $authUsername,
            ]);
        }
        $id_user = Auth::user()->id;
        $peoples = $this->peoplesRepository->getSearchUsersInPeoples($request);
//подумать над правильностью
        return view('peopleUser', compact('peoples'));
    }

    public function addPeople(){
        $users = User::select('id','username')->get();
        return view('addpeoples',["users"=>$users]);
    }

    public function store(PeopleCreateRequest $request){
        try {
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('folder');
            }else {
                $path = null;
            }
                $params = $request->all();
    
                $params['photo']=$path;
                $params['user']= Auth::user()->username;
                $params['id_user']= Auth::user()->id;
               
                $peoples = Peoples::create($params);
                
                $id_people= $peoples -> id;
                
             foreach ($request->user as $user) {
                $records = Record::create([
                    "id_user"=>$user,
                    "id_people"=>$id_people
                ]);
              
            }
            $records->save();
            $peoples->save();
            return redirect()->route('peoplelist');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id){
        $peoples= Peoples::find($id);
        $users = User::select('id','username')->get();

        return view('showPeople',["peoples"=>$peoples,"users"=>$users]);
    }

    public function update(PeopleCreateRequest $request, $id){

        if ($request->photo==null) {
            
            $params = $request->all(); 
            $peoples = Peoples::find($id);
            $params['user']= $peoples['user'];
            $result = $peoples->fill($params)->save();

            $id_people = $peoples ->id;

           $delete = Record::where('id_people',$id_people)->delete(); 
          
            foreach ($request->user as $user) {
                $records = Record::create([
                "id_user"=>$user,
                "id_people"=>$id_people]);
            }
                $records->save();
                
            return redirect()->route('peoplelist');
        }else {

       $params = $request->all(); 
       $peoples = Peoples::find($id);
       Storage::delete($peoples->photo);
        
        $path = $request->file('photo')->store('folder');
        $params['photo']=$path;
        $params['user']= $peoples['user'];
        $result = $peoples->fill($params)->save();
        
        $id_people = $peoples ->id;

        Record::where('id_people',$id_people)->delete();

            foreach ($request->user as $user) {
             $records = Record::create([
                "id_user"=>$user,
                "id_people"=>$id_people]);
            }
                $records->save();
                $peoples->save();
            return redirect()->route('peoplelist');
        }
    }

    public function destroy($id){

        try {
            $this->peoplesServices->remove($id);
            return redirect()->route('peoplesList');
        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }
}
