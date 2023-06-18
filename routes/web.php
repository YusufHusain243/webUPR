<?php

use App\Http\Controllers\BillboardController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubMenuController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [PengunjungController::class, 'index']);
    Route::get('/billboard/{slug}', [PengunjungController::class, 'detailBillboard']);
    Route::get('/rilis', [PengunjungController::class, 'rilis']);
    Route::get('/pengumuman', [PengunjungController::class, 'pengumuman']);
    Route::get('/rilis/{slug}', [PengunjungController::class, 'detailRilis']);
    Route::get('/pengumuman/{slug}', [PengunjungController::class, 'detailPengumuman']);
    Route::get('/menu/{slug}', [PengunjungController::class, 'detailMenu']);
    Route::get('/sub-menu/{slug}', [PengunjungController::class, 'detailSubMenu']);
    Route::get('/switch/{locale}', [PengunjungController::class, 'switch']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});


Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/setting', [SettingController::class, 'index']);
    Route::post('/setting', [SettingController::class, 'store']);

    Route::get('/billboard', [BillboardController::class, 'index']);
    Route::get('/add-billboard', [BillboardController::class, 'create']);
    Route::post('/add-billboard', [BillboardController::class, 'store']);
    Route::delete('/billboard/{id}', [BillboardController::class, 'destroy']);
    Route::get('/edit-billboard/{id}', [BillboardController::class, 'edit']);
    Route::patch('/edit-billboard/{id}', [BillboardController::class, 'update']);

    Route::get('/konten', [ContentController::class, 'index']);
    Route::get('/add-konten', [ContentController::class, 'create']);
    Route::post('/add-konten', [ContentController::class, 'store']);
    Route::delete('/konten/{id}', [ContentController::class, 'destroy']);
    Route::get('/edit-konten/{id}', [ContentController::class, 'edit']);
    Route::patch('/edit-konten/{id}', [ContentController::class, 'update']);

    Route::get('/menu', [MenuController::class, 'index']);
    Route::get('/add-menu', [MenuController::class, 'create']);
    Route::post('/add-menu', [MenuController::class, 'store']);
    Route::delete('/menu/{id}', [MenuController::class, 'destroy']);
    Route::get('/edit-menu/{id}', [MenuController::class, 'edit']);
    Route::patch('/edit-menu/{id}', [MenuController::class, 'update']);

    Route::get('/list-sub-menu/{id}', [SubMenuController::class, 'index']);
    Route::get('/add-sub-menu/{id}', [SubMenuController::class, 'create']);
    Route::post('/add-sub-menu/{id}', [SubMenuController::class, 'store']);
    Route::delete('/sub-menu/{id}/{id_menu}', [SubMenuController::class, 'destroy']);
    Route::get('/edit-sub-menu/{id}/{id_menu}', [SubMenuController::class, 'edit']);
    Route::patch('/edit-sub-menu/{id}/{id_menu}', [SubMenuController::class, 'update']);
});
