<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Auth\LoginController;
use \App\Http\Controllers\Admin\Auth\ForgotPasswordController; 
use \App\Http\Controllers\Admin\DashboardController;
use \App\Http\Controllers\Admin\DataMaster\UserController;
use \App\Http\Controllers\Admin\DataMaster\MerekMobilController; 
use \App\Http\Controllers\Admin\DataMaster\KotaController; 
use \App\Http\Controllers\Admin\DataMaster\SupirController; 
use \App\Http\Controllers\Admin\DataMaster\PromoController;  
use \App\Http\Controllers\Admin\DataMaster\MobilController; 
use \App\Http\Controllers\Admin\ReservasiController; 
use \App\Http\Controllers\Admin\JurusanController; 

use \App\Http\Controllers\App\HomeController; 
use \App\Http\Controllers\App\JurusanController as AppJurusanController; 
use \App\Http\Controllers\App\KeranjangController as AppKeranjangController; 

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
Route::middleware(['guest'])->group(function () {
    Route::get('/login',  [LoginController::class, 'index'])->name('login');
    Route::post('/login',  [LoginController::class, 'login']); 

    Route::get('/sosmed/{param}',  [LoginController::class, 'sosmed']);
    Route::get('/session/facebook/callback', [LoginController::class, 'facebook_callback']); 
    Route::get('/session/google/callback', [LoginController::class, 'google_callback']); 

    Route::get('/forgot-password',  [ForgotPasswordController::class, 'index']);
    Route::post('/forgot-password',  [ForgotPasswordController::class, 'send_email']); 
});
Route::middleware(['admin-handling'])->group(function () {
     
    Route::get('/',  [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard',  [DashboardController::class, 'index']);
   
    Route::post('/user/dt',  [UserController::class, 'dt']);
    Route::resource('/user',  UserController::class);

    Route::post('/merek-mobil/dt',  [MerekMobilController::class, 'dt']);
    Route::resource('/merek-mobil',  MerekMobilController::class); 

    Route::post('/kota/dt',  [KotaController::class, 'dt']);
    Route::resource('/kota',  KotaController::class); 

    Route::post('/supir/dt',  [SupirController::class, 'dt']);
    Route::resource('/supir',  SupirController::class); 

    Route::post('/promo/dt',  [PromoController::class, 'dt']);
    Route::resource('/promo',  PromoController::class); 

    Route::post('/mobil/dt',  [MobilController::class, 'dt']);
    Route::resource('/mobil',  MobilController::class); 
    Route::post('/mobil/select2-supir', [MobilController::class, 'select2_supir']);
    Route::post('/mobil/select2-merek', [MobilController::class, 'select2_merek']);

    Route::post('/jurusan/dt',  [JurusanController::class, 'dt']);
    Route::resource('/jurusan',  JurusanController::class); 
    Route::post('/jurusan/validate-kota', [JurusanController::class, 'validate_kota']);
    Route::post('/jurusan/get-kota', [JurusanController::class, 'get_kota']);
    Route::post('/jurusan/select2-kota', [JurusanController::class, 'select2_kota']);
    Route::post('/jurusan/select2-promo', [JurusanController::class, 'select2_promo']);
    Route::post('/jurusan/select2-mobil', [JurusanController::class, 'select2_mobil']);

    Route::post('/reservasi/dt',  [ReservasiController::class, 'dt']);
    Route::resource('/reservasi',  ReservasiController::class); 
});

Route::group(['prefix' => 'app'], function () {
    Route::get('home',  [HomeController::class, 'index'])->name('home'); 

    Route::get('jurusan',  [AppJurusanController::class, 'index']); 

    Route::middleware(['auth'])->group(function () {
        Route::post('jurusan',  [AppJurusanController::class, 'add']); 

        Route::get('keranjang',  [AppKeranjangController::class, 'index']); 
        Route::get('keranjang/delete/{id}',  [AppKeranjangController::class, 'delete']); 
        Route::get('keranjang/bayar',  [AppKeranjangController::class, 'bayar']);
        Route::post('keranjang/store',  [AppKeranjangController::class, 'store']);  

        
    });
});
 
Route::get('/logout',  [LoginController::class, 'logout'])->name('logout');