<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\WargaController;

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

// Keluhan
Route::get('/', [MainController::class, 'mainView'])
    ->name('view.main.page');
Route::get('buat/keluhan', [MainController::class, 'createView'])
    ->name('view.create.page');
Route::get('monitoring', [MainController::class, 'monitoringView'])
    ->name('view.monitoring.page');
Route::get('list/keluhan', [MainController::class, 'listView'])
    ->name('view.list.page');
Route::post('create/complaint', [MainController::class, 'storeComplaint'])
    ->name('store.complaiment');
Route::post('update/status/keluhan', [MainController::class, 'approvalComplaint'])
    ->name('approval.status.complaiment');
Route::prefix('ajax/keluhan')->group(function () {
    Route::get('/get/data/penduduk', [MainController::class, 'getDataWarga'])
        ->name('ajax.get.data.penduduk');
    Route::get('/open', [MainController::class, 'openAjax'])
        ->name('ajax.open.content');
    Route::get('/inprogress', [MainController::class, 'inprogressAjax'])
        ->name('ajax.inprogress.content');
    Route::get('/reject', [MainController::class, 'rejectAjax'])
        ->name('ajax.reject.content');
    Route::get('/done', [MainController::class, 'doneAjax'])
        ->name('ajax.done.content');
    Route::get('/detail/keluhan', [MainController::class, 'detailAjax'])
        ->name('ajax.detail.keluhan.content');
    Route::get('/monitoring/keluhan', [MainController::class, 'listMonitoringAjax'])
        ->name('ajax.monitoring.keluhan.content');
    Route::get('/info/selengkapnya', [MainController::class, 'infoAjax'])
        ->name('ajax.info.keluhan');
    Route::get('/pelacakan', [MainController::class, 'trackingAjax'])
        ->name('ajax.tracking.keluhan');
});

// Wilayah
Route::get('list/wilayah', [WilayahController::class, 'listWilayahView'])
    ->name('view.list.wilayah.page');
Route::get('create/wilayah', [WilayahController::class, 'createWilayahView'])
    ->name('view.create.wilayah.page');
Route::post('store/wilayah', [WilayahController::class, 'storeWilayah'])
    ->name('store.wilayah');
Route::post('edit/wilayah', [WilayahController::class, 'updateWilayah'])
    ->name('update.wilayah');
Route::get('delete/wilayah/{id_kecamatan}', [WilayahController::class, 'deleteWilayah'])
    ->name('delete.wilayah');
Route::prefix('ajax/wilayah')->group(function () {
    Route::get('/edit/wilayah', [WilayahController::class, 'editWilayahAjax'])
        ->name('ajax.edit.wilayah');
});


// Warga
Route::get('list/warga', [WargaController::class, 'listWargaView'])
    ->name('view.list.warga.page');
Route::get('create/warga', [WargaController::class, 'createWargaView'])
    ->name('view.create.warga.page');
Route::post('store/penduduk', [WargaController::class, 'storeWarga'])
    ->name('store.penduduk');
Route::post('edit/penduduk', [WargaController::class, 'updateWarga'])
    ->name('update.penduduk');
Route::get('delete/penduduk/{id_penduduk}', [WargaController::class, 'deleteWarga'])
    ->name('delete.penduduk');

Route::prefix('ajax/penduduk')->group(function () {
    Route::get('detail/data/penduduk', [WargaController::class, 'detailAjax'])
        ->name('ajax.detail.data.penduduk');
    Route::get('edit/data/penduduk', [WargaController::class, 'editAjax'])
        ->name('ajax.edit.data.penduduk');
});
