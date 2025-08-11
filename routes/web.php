<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GarantiaController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\RevendedorController;
use App\Http\Controllers\ObrigadoController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\whatsappController;
use App\Http\Controllers\SmtpController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CliquesRedeSocialController;


Route::get('/',[PrincipalController::class,'index'])->name('site.index');

Route::get('/obrigado',[ObrigadoController::class,'index'])->name('site.obrigado');

Route::get('/garantia',[GarantiaController::class,'index'])->name('garantia.index');
Route::post('/garantia',[GarantiaController::class,'store'])->name('garantia.store');

Route::get('/revendedor',[RevendedorController::class,'index'])->name('revendedor.index');
Route::post('/revendedor',[RevendedorController::class,'store'])->name('revendedor.store');

Route::get('/social-click', [CliquesRedeSocialController::class, 'registrarClique']);
Route::post('/social-click', [CliquesRedeSocialController::class, 'registrarClique']);

Auth::routes();

Route::middleware('auth')->prefix('app')->group(function () {

    Route::get('/dashboard',[dashboardController::class,'index'])->name('dashboard.index');

    Route::resource('/usuario', UsuarioController::class)->only(['index', 'create', 'store', 'destroy','edit','update']);

    Route::get('/configuracao/whatsapp',[whatsappController::class,'whatsapp'])->name('whatsapp');
    Route::post('/configuracao/whatsapp', [WhatsappController::class, 'update'])->name('whatsapp.update');

    Route::get('/configuracao/smtp', [SmtpController::class,'smtp'])->name('smtp');
    Route::post('/configuracao/smtp', [SmtpController::class,'update'])->name('smtp.update');

    Route::get('/garantia',[GarantiaController::class,'indexApp'])->name('app.garantia.index');

    Route::get('revendedor',[RevendedorController::class,'indexApp'])->name('app.revendedor.index');
    Route::get('revendedor/create',[RevendedorController::class,'create'])->name('app.revendedor.create');
    Route::post('revendedor/create',[RevendedorController::class,'storeApp'])->name('app.revendedor.store');
    Route::get('revendedor/{id}',[RevendedorController::class,'edit'])->name('app.revendedor.edit');
    Route::put('revendedor/{id}',[RevendedorController::class,'update'])->name('app.revendedor.update');
    Route::get('revendedor/{id}/aprovar', [RevendedorController::class, 'aprovar'])->name('app.revendedor.aprovar');
    Route::delete('revendedor/exluir/{id}', [RevendedorController::class, 'destroy'])->name('app.revendedor.destroy');



});