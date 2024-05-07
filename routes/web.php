<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'mainView'])
    ->name('view.main.page');
Route::get('app-aduan/buat/keluhan', [MainController::class, 'createView'])
    ->name('view.create.page');
Route::get('app-aduan/monitoring', [MainController::class, 'monitoringView'])
    ->name('view.monitoring.page');
Route::get('app-aduan/list/keluhan', [MainController::class, 'listView'])
    ->name('view.list.page');

Route::prefix('app-aduan/ajax')->group(function () {
    Route::get('app-aduan/open', [MainController::class, 'openAjax'])
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

Route::post('app-aduan/create/complaint', [MainController::class, 'storeComplaint'])
    ->name('store.complaiment');
Route::post('app-aduan/update/status/keluhan', [MainController::class, 'approvalComplaint'])
    ->name('approval.status.complaiment');
