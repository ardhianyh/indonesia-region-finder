<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProvinceController;
use Illuminate\Http\Request;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/search/provinces', function (Request $request) {
        echo $request->cookie('data-source');
    });
    Route::get('/search/cities', [CityController::class, 'getCities']);
});
