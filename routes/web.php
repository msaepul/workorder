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
    return view('login');
})->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating'])->name('authenticating');
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProses']);
});



Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('Dashboard', [AdminController::class, 'index']);
    Route::get('Adminspr', [AdminController::class, 'dashboardspr']);
    Route::get('Gallery', [AdminController::class, 'gallery']);
    Route::get('Cabang', [CabangController::class, 'index'])->middleware('only_cabang');
    Route::get('404', [AllController::class, 'index']);

    Route::get('Workorder', [WorkorderController::class, 'create'])->name('Workorder_create');
    Route::post('Workorder', [WorkorderController::class, 'woproses'])->name('Workorder_proses');

    Route::get('Datawo', [WorkorderController::class, 'datawo'])->name('Dataworkorder');
    
    Route::get('TPMRingan', [TPMController::class, 'TPMRingan'])->name('TPMRingan');
    Route::get('TPMBerat', [TPMController::class, 'TPMBerat'])->name('TPMBerat');
    Route::get('JadwalTPM', [TPMController::class, 'JadwalTPM'])->name('JadwalTPM');

    Route::get('user', [MasterDataController::class, 'user'])->name('user');
    Route::post('user', [MasterDataController::class, 'userProses'])->name('user_proses');
    Route::patch('/user/{id}', ['as' => 'user.update', 'uses' => 'App\Http\Controllers\MasterDataController@updateUser']);
    Route::delete('/delete/{id}', ['as' => 'user.delete', 'uses' => 'App\Http\Controllers\MasterDataController@deleteUser']);


    Route::delete('user/{$id}', [MasterDataController::class, 'delete']);

    Route::get('perangkat', [MasterDataController::class, 'perangkat'])->name('perangkat');
    Route::post('perangkat-proses', [MasterDataController::class, 'perangkatproses'])->name('perangkat_proses');
    Route::get('add-perangkat', [MasterDataController::class, 'tambahperangkat'])->name('add_perangkat');


 Route::get('/getbyid', [MasterDataController::class, 'getTypeByJenis'])->name('getbyid');
    Route::get('/cobaadd-perangkat', [MasterDataController::class, 'cobatambahperangkat'])->name('cobaadd_perangkat');
    

    // Route::resource('perangkat', MasterDataController::class);
    
    //proses input brand ke db
    Route::post('brand-proses', [MasterDataController::class, 'brandproses'])->name('brand_proses');

    //proses input type ke db
     Route::post('type-proses', [MasterDataController::class, 'typeproses'])->name('type_proses');



    Route::get('sparepart', [MasterDataController::class, 'sparepart'])->name('sparepart');
    Route::post('sparepart', [MasterDataController::class, 'sparepartproses'])->name('sparepart_proses');
    Route::get('tambah-sparepart', [MasterDataController::class, 'tambahsparepart'])->name('tambah_sparepart');
});
