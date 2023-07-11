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

    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('Dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('Adminspr', [AdminController::class, 'dashboardspr']);
    Route::get('Gallery', [AdminController::class, 'gallery']);
    Route::get('Cabang', [CabangController::class, 'index'])->middleware('only_cabang');

    Route::get('404', [AllController::class, 'index']);

    Route::get('profile', [AdminController::class, 'profile'])->name('profile');


    //Routing WO
    Route::prefix('Workorder')->group(function () {
        Route::get('', [WorkorderController::class, 'create'])->name('Workorder_create');
        Route::get('detail/{id}', [WorkorderController::class, 'detailwo'])->name('Workorder_detail');
        Route::get('edit/{id}', [WorkorderController::class, 'editwo'])->name('Workorder_edit');
        Route::put('edit/{id}', [WorkorderController::class, 'editwoproses'])->name('Workorder_editproses');
        Route::get('{id}', [WorkorderController::class, 'confirm'])->name('wo_confadmin');
        Route::post('', [WorkorderController::class, 'woproses'])->name('Workorder_proses');
        Route::post('updates/{id}', [WorkorderController::class, 'updateStatus'])->name('woupdate_status');
        Route::post('update/{id}', [WorkorderController::class, 'updateStatus2'])->name('woupdate_status2');
        Route::get('datawo', [WorkorderController::class, 'datawo'])->name('Dataworkorder');
    });   Route::get('datawo', [WorkorderController::class, 'datawo'])->name('Dataworkorder');


    Route::prefix('TPM')->group(function () {
        Route::get('Ringan', [TPMController::class, 'TPMRingan'])->name('TPMRingan');
        Route::get('Berat', [TPMController::class, 'TPMBerat'])->name('TPMBerat');
        Route::get('Jadwal', [TPMController::class, 'JadwalTPM'])->name('JadwalTPM');
    });

    // Routing Master Data User
    Route::prefix('user')->group(function () {
        Route::get('', [MasterController::class, 'user'])->name('user');
        Route::post('', [MasterController::class, 'userProses'])->name('user_proses');
        Route::patch('/{id}', ['as' => 'user.update', 'uses' => 'App\Http\Controllers\MasterController@updateUser']);
        Route::delete('/delete/{id}', ['as' => 'user.delete', 'uses' => 'App\Http\Controllers\MasterController@deleteUser']);
        Route::delete('/{id}', [MasterController::class, 'delete']);
    });



    Route::prefix('perangkat')->group(function () {
        Route::get('', [MasterController::class, 'perangkat'])->name('perangkat');
        Route::post('proses', [MasterController::class, 'perangkatproses'])->name('perangkat_proses');
        Route::get('add', [MasterController::class, 'tambahperangkat'])->name('add_perangkat');
        Route::get('edit/{id}', [MasterController::class, 'editperangkat'])->name('edit_perangkat');
        Route::put('{id}', [MasterController::class, 'updateperangkat'])->name('update_perangkat');
        Route::delete('{id}', [MasterController::class, 'hapusperangkat'])->name('destroy_perangkat');
    });



    Route::prefix('sparepart')->group(function () {
        Route::get('', [SparepartController::class, 'sparepart'])->name('sparepart');

        Route::post('sparepart-proses', [SparepartController::class, 'storesparepart'])->name('add_sprbaru');

        Route::get('request', [SparepartController::class, 'requestsparepart'])->name('request_sparepart');
        Route::get('history', [SparepartController::class, 'historyrequest'])->name('history_sparepart');
        Route::post('updates/{id}', [SparepartController::class, 'updatestatus'])->name('updaterequest_status');
        Route::get('detail/{id}', [SparepartController::class, 'detailrequestsparepart'])->name('detailrequest_sparepart');
        Route::get('edit/request/{id}', [SparepartController::class, 'editrequestsparepart'])->name('editrequest_sparepart');
        Route::put('editrequest/{id}', [SparepartController::class, 'editrequestsparepartproses'])->name('updaterequest_sparepart');

        Route::get('tambah', [SparepartController::class, 'txsparepart'])->name('add_sparepart');
        Route::post('tambah', [SparepartController::class, 'txsprproses'])->name('sparepart_proses');

        Route::get('keluar', [SparepartController::class, 'txsparepartout'])->name('out_sparepart');
        Route::post('keluar', [SparepartController::class, 'txsparepartoutproses'])->name('sparepartout_proses');

        Route::get('edit/{id}', [SparepartController::class, 'editsparepart'])->name('sparepart_edit');
        Route::put('{id}', [SparepartController::class, 'updatesparepart'])->name('sparepart_update');
        Route::delete('{id}', [SparepartController::class, 'hapussparepart'])->name('destroy_sparepart');
    });


    // Route::get('/getbyid', [MasterController::class, 'getTypeByJenis'])->name('getbyid');
    // Route::get('/cobaadd-perangkat', [MasterController::class, 'cobatambahperangkat'])->name('cobaadd_perangkat');
    // Route::resource('perangkat', MasterController::class);

    //proses input brand ke db
    Route::post('brand-proses', [MasterController::class, 'brandproses'])->name('brand_proses');

    //proses input type ke db
    Route::post('type-proses', [MasterController::class, 'typeproses'])->name('type_proses');


    //Master Data Supplier
    Route::post('supplier-proses', [MasterController::class, 'supplierproses'])->name('supplier_proses');
});
