<?php

use Illuminate\Support\Facades\Route;

use App\Notifications\Users;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/viewMessages', [App\Http\Controllers\HomeController::class, 'viewMessages']);
    Route::get('/listmessage/{id}', [App\Http\Controllers\HomeController::class, 'showmessages']);
    Route::post('/message', [App\Http\Controllers\HomeController::class,'sendMessage']);

Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['role:user_сitisen|admin']],function(){
    Route::get('/citisenuser', [App\Http\Controllers\HomeController::class, 'indexcitisen'])->name('homeuser');
    Route::get('/search',[App\Http\Controllers\HomeController::class, 'search'])->name('search');
    Route::get('/searchUsers',[App\Http\Controllers\HomeController::class, 'searchUsers'])->name('searchUsers');
    
    Route::get('/citisen/{id}', [App\Http\Controllers\CitisenControl::class, 'show']);
    Route::get('citisen/citisenBorder/{id}', [App\Http\Controllers\CitisenControl::class, 'showBorderCitisen']);
    Route::get('/citisens/exports', [App\Services\CitisensServices::class, 'CitisenExport']);


    Route::get('/searchPeople',[App\Http\Controllers\PeoplesController::class, 'searchPeople'])->name('searchPeople');
    Route::get('/searchPeopleUser',[App\Http\Controllers\PeoplesController::class, 'searchPeopleUser'])->name('searchPeopleUser');

    Route::get('/peoplelist',[App\Http\Controllers\PeoplesController::class, 'index'])->name('peoplelist');
    Route::get('/peopleuser', [App\Http\Controllers\PeoplesController::class, 'indexUser'])->name('peopleuser');
    Route::get('/people/{id}', [App\Http\Controllers\PeoplesController::class, 'show']);

     });

Route::group(['middleware'=>['role:user_сitisen_add|admin']],function(){

    Route::get('/addcitisens', [App\Http\Controllers\CitisenControl::class, 'index']);

    Route::post('/citisens', [App\Http\Controllers\CitisenControl::class, 'store']);
    Route::post('/citisens/import', [App\Services\CitisensServices::class, 'CitisenImport']);
    Route::post('/citisens/importNoHead', [App\Services\CitisensServices::class, 'CitisenImportNoHead']);
    Route::get('/destroyCitisen/{id}', [App\Http\Controllers\CitisenControl::class, 'destroy']);

    Route::get('/addpeoples', [App\Http\Controllers\PeoplesController::class, 'addPeople']);
    Route::post('/peoplesadd', [App\Http\Controllers\PeoplesController::class, 'store']);
    Route::get('/destroyPeople/{id}', [App\Http\Controllers\PeoplesController::class, 'destroy']);
});

Route::group(['middleware'=>['role:user_сitisen_upd|admin']],function(){
    Route::post('/citisen/{id}', [App\Http\Controllers\CitisenControl::class, 'update'])->name('citisen');

    Route::post('/people/{id}', [App\Http\Controllers\PeoplesController::class, 'update'])->name('people');
});



Route::group(['middleware'=>['role:user_avto|admin']],function(){
        Route::get('/searchAvto',[App\Http\Controllers\AvtosController::class, 'searchAvto'])->name('searchAvto');
        Route::get('/searchAvtoUser',[App\Http\Controllers\AvtosController::class, 'searchAvtoUser'])->name('searchAvtoUser');
        Route::get('/avtoslist', [App\Http\Controllers\AvtosController::class, 'index'])->name('avtoslist');
        Route::get('/avtoslistusers', [App\Http\Controllers\AvtosController::class, 'indexavto']);

        Route::get('/avto/{id}', [App\Http\Controllers\AvtosController::class, 'show']);
        Route::get('avto/avtoBorder/{id}', [App\Http\Controllers\AvtosController::class, 'showBorderAvtos']);
        Route::get('/avtos/exports', [App\Services\AvtosServices::class, 'AvtosExport']);
        
        });

Route::group(['middleware'=>['role:user_avto_add|admin']],function(){ 
    Route::get('/addavtos', [App\Http\Controllers\AvtosController::class, 'indexAdd']);
    Route::get('/addcitis', [App\Http\Controllers\AvtosController::class, 'indexCitisen']);
    Route::post('/avtos', [App\Http\Controllers\AvtosController::class, 'store']);
    Route::post('/avtos/import', [App\Services\AvtosServices::class, 'AvtosImport']);
    Route::get('/destroy/{id}', [App\Http\Controllers\AvtosController::class, 'destroy']);
});      

Route::group(['middleware'=>['role:user_avto_upd|admin']],function(){ 
    Route::post('/avto/{id}', [App\Http\Controllers\AvtosController::class, 'update']);
});      

Route::group(['middleware'=>['role:user_border|admin']],function(){
    Route::get('/searchBorders',[App\Http\Controllers\BorderController::class, 'searchBorders'])->name('searchBorders');
    Route::get('/searchBordersUser',[App\Http\Controllers\BorderController::class, 'searchBordersUser'])->name('searchBordersUser');
    Route::get('/borderslist', [App\Http\Controllers\BorderController::class, 'index']);
    Route::get('/borderslistUser', [App\Http\Controllers\BorderController::class, 'indexUser']);
    // Route::get('/addborder', [App\Http\Controllers\BorderController::class, 'indexAdd']);

    // Route::get('/addavtos', [App\Http\Controllers\BorderController::class, 'indexAvtos']);
    Route::get('/border/{id}', [App\Http\Controllers\BorderController::class, 'show']);
    
    Route::get('/borders/exports', [App\Services\BordersServices::class, 'BordersExport']);
    
    });
    
Route::group(['middleware'=>['role:user_border_add|admin']],function(){ 
    Route::post('/borders', [App\Http\Controllers\BorderController::class, 'store']);
    Route::get('/addborder', [App\Http\Controllers\BorderController::class, 'indexa']);
    Route::get('/destroyborder/{id}', [App\Http\Controllers\BorderController::class, 'destroy']);
    Route::post('/borders/import', [App\Services\BordersServices::class, 'BordersImport']);
});
Route::group(['middleware'=>['role:user_border_upd|admin']],function(){
    Route::post('/border/{id}', [App\Http\Controllers\BorderController::class, 'update']);
});
 

Route::group(['middleware'=>['role:admin']],function(){
        Route::get('/logs',[App\Http\Controllers\LogController::class, 'show']);
        
        Route::get('/usersList', [App\Http\Controllers\UsersController::class, 'index'])->name('usersList');
            
        Route::get('/addusers', [App\Http\Controllers\UsersController::class, 'indexUser']);
        Route::post('/users', [App\Http\Controllers\UsersController::class, 'store']);
        
        Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'show']);
        Route::post('/users/{id}', [App\Http\Controllers\UsersController::class, 'update']);
        Route::get('/destroyuser/{id}', [App\Http\Controllers\UsersController::class, 'destroy']);
});





