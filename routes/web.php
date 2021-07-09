<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitisensController;

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

Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['role:user_сitisen|admin']],function(){
    Route::get('/addcitisens', [App\Http\Controllers\CitisenControl::class, 'index']);
     Route::get('/citisen/{id}', [App\Http\Controllers\CitisenControl::class, 'show']);
     Route::post('/citisen/{id}', [App\Http\Controllers\CitisenControl::class, 'update'])->name('citisen');
     Route::get('/destroyCitisen/{id}', [App\Http\Controllers\CitisenControl::class, 'destroy']);
     Route::post('/citisens', [App\Http\Controllers\CitisenControl::class, 'store']);
     Route::get('/citisens/exports', [App\Http\Controllers\CitisenControl::class, 'CitisenExport']);
     Route::post('/citisens/import', [App\Http\Controllers\CitisenControl::class, 'CitisenImport']);
     Route::post('/citisens/importNoHead', [App\Http\Controllers\CitisenControl::class, 'CitisenImportNoHead']);
   
     });

Route::group(['middleware'=>['role:user_avto|admin']],function(){
        Route::get('/avtoslist', [App\Http\Controllers\AvtosController::class, 'index']);
        Route::get('/addavtos', [App\Http\Controllers\AvtosController::class, 'indexAdd']);
        Route::get('/addcitis', [App\Http\Controllers\AvtosController::class, 'indexCitisen']);
        Route::post('/avtos', [App\Http\Controllers\AvtosController::class, 'store']);
        Route::get('/avto/{id}', [App\Http\Controllers\AvtosController::class, 'show']);
        Route::post('/avto/{id}', [App\Http\Controllers\AvtosController::class, 'update']);
        Route::get('/destroy/{id}', [App\Http\Controllers\AvtosController::class, 'destroy']);
        });

Route::group(['middleware'=>['role:user_border|admin']],function(){
    Route::get('/borderslist', [App\Http\Controllers\BorderController::class, 'index']);
    // Route::get('/addborder', [App\Http\Controllers\BorderController::class, 'indexAdd']);
    Route::post('/borders', [App\Http\Controllers\BorderController::class, 'store']);
    Route::get('/addborder', [App\Http\Controllers\BorderController::class, 'indexa']);
    // Route::get('/addavtos', [App\Http\Controllers\BorderController::class, 'indexAvtos']);
    Route::get('/border/{id}', [App\Http\Controllers\BorderController::class, 'show']);
    Route::post('/border/{id}', [App\Http\Controllers\BorderController::class, 'update']);
    Route::get('/destroyborder/{id}', [App\Http\Controllers\BorderController::class, 'destroy']);
    });
 

        Route::group(['middleware'=>['role:admin']],function(){

        
            Route::get('/usersList', [App\Http\Controllers\UsersController::class, 'index'])->name('usersList');
            
            Route::get('/addusers', [App\Http\Controllers\UsersController::class, 'indexUser']);
            Route::post('/users', [App\Http\Controllers\UsersController::class, 'store']);
        
            Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'show']);
            Route::post('/users/{id}', [App\Http\Controllers\UsersController::class, 'update']);
            Route::get('/destroyuser/{id}', [App\Http\Controllers\UsersController::class, 'destroy']);
        });





