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

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('Dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('calender', [AdminController::class, 'calender'])->name('calender');
    // Route::get('Adminspr', [AdminController::class, 'dashboardspr']);
    Route::get('Gallery', [AdminController::class, 'gallery']);
    Route::get('Cabang', [CabangController::class, 'index'])->middleware('only_cabang');

    Route::get('404', [AllController::class, 'index']);

    Route::get('profile', [AdminController::class, 'profile'])->name('profile');


    //Routing WO
    Route::prefix('Workorder')->group(function () {
        Route::get('', [WorkorderController::class, 'create'])->name('Workorder_create');
        Route::get('detail/{id}', [WorkorderController::class, 'detailwo'])->name('Workorder_detail');
        Route::get('detail/{id}/pdf', [WorkorderController::class, 'generatePDF'])->name('detailrequest_sparepart.pdf');
        Route::get('edit/{id}', [WorkorderController::class, 'editwo'])->name('Workorder_edit');
        Route::put('edit/{id}', [WorkorderController::class, 'editwoproses'])->name('Workorder_editproses');

        Route::get('{id}', [WorkorderController::class, 'confirm'])->name('wo_confadmin');
        Route::post('', [WorkorderController::class, 'woproses'])->name('Workorder_proses');
        Route::post('updates/{id}', [WorkorderController::class, 'updateStatus'])->name('woupdate_status');
        Route::post('update/{id}', [WorkorderController::class, 'updateStatus2'])->name('woupdate_status2');
        // Route::get('datawo', [WorkorderController::class, 'datawo'])->name('Dataworkorder');
    });
    Route::get('datawo', [WorkorderController::class, 'datawo'])->name('Dataworkorder');
    Route::get('datawoall', [WorkorderController::class, 'datawoall'])->name('datawoall');



    Route::get('/export', [WorkorderController::class, 'export'])->name('export_wo');
    Route::get('/exportwo', [WorkorderController::class, 'exportWOCabang'])->name('exportWOCabang');


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
        Route::get('detail/{id}', [MasterController::class, 'detailperangkat'])->name('detail_perangkat');
        Route::put('{id}', [MasterController::class, 'updateperangkat'])->name('update_perangkat');
        Route::delete('{id}', [MasterController::class, 'hapusperangkat'])->name('destroy_perangkat');
    });



    Route::prefix('sparepart')->group(function () {
        Route::get('', [SparepartController::class, 'sparepart'])->name('sparepart');
        Route::get('master', [SparepartController::class, 'mastersparepart'])->name('mastersparepart');
        Route::put('editmaster/{id}', [SparepartController::class, 'masteredit'])->name('masteredit');
        // Route::get('', [SparepartController::class, 'sparepart'])->name('stoksparepart');

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

    //Master Data brand ke db
    Route::get('brand', [MasterController::class, 'masterbrand'])->name('masterbrand');
    Route::post('brand-proses', [MasterController::class, 'brandproses'])->name('brand_proses');
    Route::put('editbrand/{id}', [MasterController::class, 'mastereditbrand'])->name('mastereditbrand');

    Route::delete('brand/{id}', [MasterController::class, 'hapusbrand'])->name('destory_brand');





    //Master Data Supplier
    Route::post('supplier-proses', [MasterController::class, 'supplierproses'])->name('supplier_proses');
    //Master Data brand ke db
    Route::get('supplier', [MasterController::class, 'mastersupplier'])->name('mastersupplier');
    Route::put('editsupplier/{id}', [MasterController::class, 'mastereditsupplier'])->name('mastereditsupplier');
    Route::delete('supplier/{id}', [MasterController::class, 'hapussupplier'])->name('destory_supplier');


    // Master Data Departemen

    Route::get('departemen', [MasterController::class, 'masterdepartemen'])->name('masterdepartemen');
    Route::post('departemen-proses', [MasterController::class, 'departemenproses'])->name('departemen_proses');
    Route::put('editdepartemen/{id}', [MasterController::class, 'mastereditdepartemen'])->name('mastereditdepartemen');
    Route::delete('departemen/{id}', [MasterController::class, 'hapusdepartemen'])->name('destory_departemen');

    //  Master Data Cabang
    Route::get('cabang', [MasterController::class, 'mastercabang'])->name('mastercabang');
    Route::post('cabang-proses', [MasterController::class, 'cabangproses'])->name('cabang_proses');
    Route::put('editcabang/{id}', [MasterController::class, 'mastereditcabang'])->name('mastereditcabang');
    Route::delete('cabang/{id}', [MasterController::class, 'hapuscabang'])->name('destory_cabang');

    //Master Data jenis ke db
    Route::get('jenis', [MasterController::class, 'masterjenis'])->name('masterjenis');
    Route::post('jenis-proses', [MasterController::class, 'jenisproses'])->name('jenis_proses');
    Route::put('editjenis/{id}', [MasterController::class, 'mastereditjenis'])->name('mastereditjenis');

    Route::delete('jenis/{id}', [MasterController::class, 'hapusjenis'])->name('destory_jenis');

    //Master Data type ke db
    Route::get('type', [MasterController::class, 'mastertype'])->name('mastertype');
    Route::post('type-proses', [MasterController::class, 'typeproses'])->name('type_proses');
    Route::put('edittype/{id}', [MasterController::class, 'masteredittype'])->name('masteredittype');

    Route::delete('type/{id}', [MasterController::class, 'hapustype'])->name('destory_type');
});
