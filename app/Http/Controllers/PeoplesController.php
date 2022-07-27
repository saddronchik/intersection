<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class PeoplesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('peoplelist');
    }
}
