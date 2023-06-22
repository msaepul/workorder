<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllController;
use App\Http\Controllers\TPMController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SparepartController;

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
    $random = random_str(7);
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

    Route::get('user', [MasterController::class, 'user'])->name('user');
    Route::post('user', [MasterController::class, 'userProses'])->name('user_proses');
    Route::patch('/user/{id}', ['as' => 'user.update', 'uses' => 'App\Http\Controllers\MasterController@updateUser']);
    Route::delete('/delete/{id}', ['as' => 'user.delete', 'uses' => 'App\Http\Controllers\MasterController@deleteUser']);


    Route::delete('user/{$id}', [MasterController::class, 'delete']);

    //Routing Master Data Perangkat
    Route::get('perangkat', [MasterController::class, 'perangkat'])->name('perangkat');
    Route::post('perangkat-proses', [MasterController::class, 'perangkatproses'])->name('perangkat_proses');
    Route::get('add-perangkat', [MasterController::class, 'tambahperangkat'])->name('add_perangkat');
    Route::get('/edit-perangkat/{id}', [MasterController::class, 'editperangkat'])->name('edit-perangkat');
    // Route::put('/perangkat/{id}', [MasterController::class, 'editperangkat'])->name('update-perangkat');
    Route::put('/perangkat/{id}', [MasterController::class, 'updateperangkat'])->name('update_perangkat');
    Route::delete('/perangkat/{id}', [MasterController::class, 'hapusperangkat'])->name('destroy_perangkat');

    //Routing Master Data Sparepart   
    Route::get('sparepart', [SparepartController::class, 'sparepart'])->name('sparepart');
    Route::get('sparepart/create', [SparepartController::class, 'createsparepart'])->name('add_sparepart');
    Route::post('/spareparts', [SparepartController::class, 'storesparepart'])->name('sparepart_proses');
    Route::get('/spareparts/{id}/edit', [SparepartController::class, 'editsparepart'])->name('sparepart_edit');
    Route::put('/spareparts/{id}', [SparepartController::class, 'updatesparepart'])->name('sparepart_update');
    Route::delete('/sparepart/{id}', [SparepartController::class, 'hapussparepart'])->name('destroy_sparepart');

    // Route::get('/getbyid', [MasterController::class, 'getTypeByJenis'])->name('getbyid');
    // Route::get('/cobaadd-perangkat', [MasterController::class, 'cobatambahperangkat'])->name('cobaadd_perangkat');
    // Route::resource('perangkat', MasterController::class);

    //proses input brand ke db
    Route::post('brand-proses', [MasterController::class, 'brandproses'])->name('brand_proses');

    //proses input type ke db
    Route::post('type-proses', [MasterController::class, 'typeproses'])->name('type_proses');
});
