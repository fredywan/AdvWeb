<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ctrl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/
Route::get("/",[ctrl::class,"index"]);
Route::get("/redirect",[ctrl::class,"redirectFunct"]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add',[ctrl::class,'add']);
Route::post('/register',[ctrl::class,'register']);
Route::get('/view',[ctrl::class,'view']);
Route::get('/del/{xx}',[ctrl::class,'delete']);
Route::get('/upd/{xx}',[ctrl::class,'update']);
Route::post('/edit',[ctrl::class,'updateForm']);
Route::get('/viewProj',[ctrl::class,'viewProj']);
Route::get('/update/{xx}',[ctrl::class,'updProj']);
Route::post('/upload',[ctrl::class,'updForm']);