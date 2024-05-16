<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\KewilayahanController;
use App\Http\Controllers\KependudukanController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main menu
Route::get('/', [AuthController::class, 'mainMenuView'])
    ->name('view.main.menu.page');
Route::post('/login/process', [AuthController::class, 'login'])
    ->name('login.process');
Route::get('/logout/process', [AuthController::class, 'logout'])
    ->name('logout.process');

// Application Keluhan
Route::prefix('/app/keluhan/')->group(function () {
    Route::get('login', [KeluhanController::class, 'loginView'])
        ->name('view.keluhan.login.page');
    Route::get('/main/page', [KeluhanController::class, 'mainView'])
        ->name('view.main.page');
    Route::get('buat/keluhan', [KeluhanController::class, 'createView'])
        ->name('view.create.page');
    Route::get('monitoring', [KeluhanController::class, 'monitoringView'])
        ->name('view.monitoring.page');
    Route::get('list/keluhan', [KeluhanController::class, 'listView'])
        ->name('view.list.page');
    Route::post('create/complaint', [KeluhanController::class, 'storeComplaint'])
        ->name('store.complaiment');
    Route::post('update/status/keluhan', [KeluhanController::class, 'approvalComplaint'])
        ->name('approval.status.complaiment');

    Route::prefix('ajax/keluhan')->group(function () {
        Route::get('/get/data/penduduk', [KeluhanController::class, 'getDataWarga'])
            ->name('ajax.get.data.penduduk');
        Route::get('/open', [KeluhanController::class, 'openAjax'])
            ->name('ajax.open.content');
        Route::get('/inprogress', [KeluhanController::class, 'inprogressAjax'])
            ->name('ajax.inprogress.content');
        Route::get('/reject', [KeluhanController::class, 'rejectAjax'])
            ->name('ajax.reject.content');
        Route::get('/done', [KeluhanController::class, 'doneAjax'])
            ->name('ajax.done.content');
        Route::get('/detail/keluhan', [KeluhanController::class, 'detailAjax'])
            ->name('ajax.detail.keluhan.content');
        Route::get('/monitoring/keluhan', [KeluhanController::class, 'listMonitoringAjax'])
            ->name('ajax.monitoring.keluhan.content');
        Route::get('/info/selengkapnya', [KeluhanController::class, 'infoAjax'])
            ->name('ajax.info.keluhan');
        Route::get('/pelacakan', [KeluhanController::class, 'trackingAjax'])
            ->name('ajax.tracking.keluhan');
    });
});

// Application Kependudukan
Route::prefix('/app/kependudukan/')->group(function () {
    Route::get('login', [KependudukanController::class, 'loginView'])
        ->name('view.kependudukan.login.page');
    Route::get('list/warga', [KependudukanController::class, 'listWargaView'])
        ->name('view.list.warga.page');
    Route::get('create/warga', [KependudukanController::class, 'createWargaView'])
        ->name('view.create.warga.page');
    Route::post('store/penduduk', [KependudukanController::class, 'storeWarga'])
        ->name('store.penduduk');
    Route::post('edit/penduduk', [KependudukanController::class, 'updateWarga'])
        ->name('update.penduduk');
    Route::get('delete/penduduk/{id_penduduk}', [KependudukanController::class, 'deleteWarga'])
        ->name('delete.penduduk');

    Route::prefix('ajax/penduduk')->group(function () {
        Route::get('detail/data/penduduk', [KependudukanController::class, 'detailAjax'])
            ->name('ajax.detail.data.penduduk');
        Route::get('edit/data/penduduk', [KependudukanController::class, 'editAjax'])
            ->name('ajax.edit.data.penduduk');
    });
});

// Application Kewilayahan
Route::prefix('/app/kewilayahan/')->group(function () {
    Route::get('login', [KewilayahanController::class, 'loginView'])
        ->name('view.kewilayahan.login.page');
    Route::get('list/wilayah', [KewilayahanController::class, 'listWilayahView'])
        ->name('view.list.wilayah.page');
    Route::get('create/wilayah', [KewilayahanController::class, 'createWilayahView'])
        ->name('view.create.wilayah.page');
    Route::post('store/wilayah', [KewilayahanController::class, 'storeWilayah'])
        ->name('store.wilayah');
    Route::post('edit/wilayah', [KewilayahanController::class, 'updateWilayah'])
        ->name('update.wilayah');
    Route::get('delete/wilayah/{id_kecamatan}', [KewilayahanController::class, 'deleteWilayah'])
        ->name('delete.wilayah');
    Route::prefix('ajax/wilayah')->group(function () {
        Route::get('/edit/wilayah', [KewilayahanController::class, 'editWilayahAjax'])
            ->name('ajax.edit.wilayah');
    });
});