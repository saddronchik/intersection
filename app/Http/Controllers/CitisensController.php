<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CitisensController extends Controller
{
    public function index()
    {
        return view('addcitisens');
    }
    public function store(Request $request){        
     

            $path = $request->file('photo')->store('folder');
            $params = $request->only(['full_name','passport_data','photo','date_birth','place_residence','phone_number','social_account','addit_inf']);

          
            $params['photo']=$path;

            $citizen = Citizen::create($params);
  
       
        if ($citizen) {
           return redirect()->route('home');
        }
        }

        public function show($id){
            $citizen = Citizen::find($id);
            dd($citizen);
            return view('showCitisen',compact('citizen'));
        }
}
