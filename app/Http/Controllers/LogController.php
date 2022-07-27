<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function show()
    {
        $logs=Log::orderby('time', 'desc')->paginate(100);


        // dd($logs);
        return view('logs')->with(compact('logs'));
    }
}
