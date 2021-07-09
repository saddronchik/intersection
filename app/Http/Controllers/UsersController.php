<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // $users = User::all();
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
            // 'email' => $data['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole($request['role_citisen']);
        $user->assignRole($request['role_avto']);
        $user->assignRole($request['role_border']);
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
       $users->assignRole($request['role_avto']);
       $users->assignRole($request['role_border']);
       $users->assignRole($request['role_admin']);

        // $users->assignRole($request->input('roles'));


        $users->save();
        // dd($users);
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
        User::destroy($id);
        return redirect()->route('usersList');
    }
}
