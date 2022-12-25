<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllController;
use App\Http\Controllers\TPMController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\MasterDataController;

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
})->middleware('auth');

Route::middleware('guest')->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login',[AuthController::class,'authenticating']);
    Route::get('register', [AuthController::class,'register']);
    Route::post('register', [AuthController::class,'registerProses']);
});



Route::middleware('auth')->group(function(){
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('Admin', [AdminController::class, 'index'])->middleware('only_admin');
    Route::get('Gallery', [AdminController::class, 'gallery'])->middleware('only_admin');
    Route::get('Cabang', [CabangController::class, 'index'])->middleware('only_cabang');
    Route::get('404',[AllController::class,'index']);

    Route::get('Workorder',[WorkorderController::class,'create'])->name('Workorder_create'); 
    Route::post('Workorder',[WorkorderController::class,'woproses'])->name('Workorder_proses'); 

    Route::get('Datawo',[WorkorderController::class,'datawo'])->name('Dataworkorder'); 

    Route::get('TPMRingan',[TPMController::class,'TPMRingan'])->name('TPMRingan')->middleware('only_admin'); 
    Route::get('TPMBerat',[TPMController::class,'TPMBerat'])->name('TPMBerat')->middleware('only_admin'); 
    Route::get('JadwalTPM',[TPMController::class,'JadwalTPM'])->name('JadwalTPM')->middleware('only_admin'); 

    Route::get('user',[MasterDataController::class,'user'])->name('user')->middleware('only_admin'); 
    Route::post('user', [MasterDataController::class,'userProses'])->name('user_proses')->middleware('only_admin');
    Route::patch('/user/{id}', ['as' => 'user.update', 'uses' => 'App\Http\Controllers\MasterDataController@updateUser']);
    Route::delete('/delete/{id}', ['as' => 'user.delete', 'uses' => 'App\Http\Controllers\MasterDataController@deleteUser']);
 
   
    Route::delete('user/{$id}',[MasterDataController::class,'delete'])->middleware('only_admin');


    Route::get('perangkat',[MasterDataController::class,'perangkat'])->name('perangkat')->middleware('only_admin'); 
    Route::post('perangkat', [MasterDataController::class,'perangkatproses'])->name('perangkat_proses')->middleware('only_admin');


    Route::get('sparepart',[MasterDataController::class,'sparepart'])->name('sparepart')->middleware('only_admin'); 
});