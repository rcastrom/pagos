<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ListadoPDFController;

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

Auth::routes(['register'=>false,'password_request'=>false]);

Route::get('/', function (){
   return redirect('/login');
});
Route::middleware('auth')->prefix('home')->group(function (){
        Route::get('/',  [HomeController::class,'index'])->name('home');
        Route::get('/inscritos',[HomeController::class,'registro']);
        Route::get('/registros',[HomeController::class,'buscar']);
        Route::post('/busqueda',[HomeController::class,'busqueda'])->name('busqueda');
        Route::get('/listado',[HomeController::class,'listado1']);
        Route::post('/listado',[ListadoPDFController::class,'crearPDF'])->name('listado_pdf');
        Route::get('/eliminar/{control}',[HomeController::class,'eliminar1']);
        Route::get('/validar/{control}',[HomeController::class,'pago1']);
        Route::get('/imprimir/{control}',[HomeController::class,'imprimir1']);
        Route::post('/liberar',[HomeController::class,'pago2'])->name('liberar2');
        Route::post('/cancelar',[HomeController::class,'eliminar2'])->name('borrar');
        Route::post('/impresion',[PDFController::class,'crearPDF'])->name('imprimir');
        Route::get('/camisetas',[HomeController::class,'camisetas']);
        Route::get('/import',[HomeController::class,'importForm'])->name('pagos.importForm');
        Route::post('/import',[HomeController::class,'importar'])->name('pagos.import');
        Route::get('/liberar',[HomeController::class,'mandar_correos']);

    });

