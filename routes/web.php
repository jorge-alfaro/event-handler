<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/metas/add', function () {
    return Response::view('metas.metas');
});
Route::post('/metas', function (Request $request) {
    return Response::json(['message' => "Lina"])->setStatusCode(400);
});

Route::get('events/create',[EventController::class, 'create'])->name('events.create');
Route::post('events/',[EventController::class, 'store'])->name('events.store');
