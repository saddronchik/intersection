<?php

namespace App\Http\Middleware;

use App\Models\Citizen;
use Closure;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;
use DateTimeInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DataLogger
{
    private $startTime;
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
    
        $this->startTime = microtime(true);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // dd($request);
    //  dd(session());
    
       
    if ( env('API_DATALOGGER', true) ) {
        if ( env('API_DATALOGGER_USE_DB', true) ) {
           
            $endTime = microtime(true);
            
            $log = new Log();
            @$user = Auth::user()->username;
            
          
            if (!$user) {
                $user = null;
            }else
            $user = Auth::user()->username;
            
            date_default_timezone_set("Europe/Moscow");
            $log->time = date('Y-m-d H:i:s');
            
            $log->duration = number_format($endTime - LARAVEL_START, 3);
               
            $log->ip = $request->ip();
            
            $log->id_user = $user;
            // $log->actions = $request->all('full_name','passport_data','date_birth','place_residence','phone_number','social_account','addit_inf');
            
            $ctizenLog = $request->all();
            
            if(@$ctizenLog['password']){
                $ctizenLog['password']= Hash::make($request['password']);
                $log->actions = implode(" : ",$ctizenLog);
            }
            if(@$ctizenLog['user']){
                $ctiz =  implode(" ; ",  $ctizenLog['user']);
                $ctizenLog['user'] = 'id users :'. $ctiz ;
            }
            @$log->actions = implode(" : ",$ctizenLog);

            $log->url = $request->url();
            $log->method = $request->method();
            $log->input = $request->getContent();

            
            @$log->save();
            

            
        }
        else
        {
            $endTime = microtime(true);
            $filename = 'api_datalogger_' . date('d-m-y') . '.log';
            $dataToLog  = 'Time: '   . gmdate("F j, Y, g:i a") . "\n";
            $dataToLog .= 'Duration: ' . number_format($endTime - LARAVEL_START, 3) . "\n";
            $dataToLog .= 'IP Address: ' . $request->ip() . "\n";
            $dataToLog .= 'ID User: ' . $request->id_user() . "\n";
            $dataToLog .= 'URL: '    . $request->fullUrl() . "\n";
            $dataToLog .= 'Method: ' . $request->method() . "\n";
            $dataToLog .= 'Input: '  . $request->getContent() . "\n";
            \File::append( storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog . "\n" . str_repeat("=", 20) . "\n\n");
        }
        }
    }
}
