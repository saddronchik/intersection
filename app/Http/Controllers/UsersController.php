<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                    ->leftJoin('model_has_roles','model_has_roles.model_id','=','users.id')
                    ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
                    ->select('users.id','users.username','model_has_roles.role_id','roles.name')
                    ->get();

        return view('users',[
            "users"=>$users
        ]);
    }
    public function indexUser(){
        return view('addusers');
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
        
        $user = User::create([
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole($request['role_citisen']);
        $user->assignRole($request['role_citisen_add']);
        $user->assignRole($request['role_citisen_upd']);
        $user->assignRole($request['role_avto']);
        $user->assignRole($request['role_avto_add']);
        $user->assignRole($request['role_avto_upd']);
        $user->assignRole($request['role_border']);
        $user->assignRole($request['role_border_add']);
        $user->assignRole($request['role_border_upd']);
        $user->assignRole($request['role_admin']);
        
        return $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('showUsers',compact('user'));        
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
    public function update(Request $request,$id)
    {
        $params = $request->only(['id','username']); 
        $users = User::find($params['id']);
        
        $users->username = $params["username"];
       
       DB::table('model_has_roles')->where('model_id',$users->id)->delete(); 
       $users->assignRole($request['role_citisen']);
       $users->assignRole($request['role_citisen_add']);
       $users->assignRole($request['role_citisen_upd']);
       $users->assignRole($request['role_avto']);
       $users->assignRole($request['role_avto_add']);
       $users->assignRole($request['role_avto_upd']);
       $users->assignRole($request['role_border']);
       $users->assignRole($request['role_border_add']);
       $users->assignRole($request['role_border_upd']);
       $users->assignRole($request['role_admin']);

       $users->save();

       return  $users;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $messageFromUser = Message::where('from_user','=',$id)->delete();
       
        User::destroy($id);
        
        return redirect()->route('usersList');
    }
}
