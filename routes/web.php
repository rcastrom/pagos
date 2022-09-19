<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::controller(HomeController::class)
    ->middleware('auth')
    ->prefix('home')
    ->group(function (){
        Route::get('/',  'index')->name('home');
        Route::get('/inscritos','registro');
        Route::get('/pagado','pago1');
        Route::post('/registrar','pago2')->name('liberar');
    });
