<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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


// Upload video 
/*Route::get("posts",[PostController::class,'display'])->name("display");
Route::post("posts",[PostController::class,'insert'])->name("insert");
Route::get("play",[PostController::class,'play'])->name("play");*/