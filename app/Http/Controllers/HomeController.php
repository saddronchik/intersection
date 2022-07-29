<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Message;
use App\Repositories\CitisensRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $citisensRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CitisensRepository $citisensRepository )
    {
        $this->middleware('auth');
        $this->citisensRepository = $citisensRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $citisens = $this->citisensRepository->getAll();
        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;
        return view('home', [
            'citisens'=>$citisens,
            'authUser' => $authUser,
            'authUsername' => $authUsername,
        ]);
    }

    public function indexcitisen(){
        $id_user = Auth::user()->id;
        $citisens = $this->citisensRepository->getCizensJoinRecordsUsers() ;
        return view('citisenUser', [
            'citisens'=>$citisens,
            'id_user'=>$id_user
        ]);
    }

    public function search(Request $request){
        
        $authUser = Auth::user()->id;
        $authUsername = Auth::user()->username;
        $citisens = $this->citisensRepository->getSearchCitisens($request) ;
       
        return view('home',  [
            'citisens'=>$citisens,
            'authUser' => $authUser,
            'authUsername' => $authUsername, 
        ]);
    }

    public function searchUsers(Request $request){
        $s = $request->s;
        if (is_null($s)) {
            $id_user = Auth::user()->id;
            $authUsername = Auth::user()->username;
            $citisens =  $this->citisensRepository->getSearchUsersNullInCitisens($request);

            return view('citisenUser', [
                'citisens'=>$citisens,
                'id_user'=>$id_user,
                'authUsername' => $authUsername,
            ]);
        }
        
        $id_user = Auth::user()->id;
        $citisens = $this->citisensRepository->getSearchUsersInCitisens($request);
//подумать над правильностью
        return view('citisenUser', compact('citisens'));
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
    
    public function destroyMessage($id){
        Message::destroy($id);
    }
}
