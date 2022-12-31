<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
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

Route::middleware(['auth'])->group(function () {
    // Only authenticated users may access this route...
    Route::prefix('event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/create',[EventController::class, 'create'])->name('events.create');
        Route::post('/',[EventController::class, 'store'])->name('events.store');
    });
    Route::prefix('member')->group( function (){
       Route::get('/',[MemberController::class, 'index'])->name('members.index');
       Route::get('/create',[MemberController::class, 'create'])->name('members.create');
       Route::post('/',[MemberController::class, 'store'])->name('members.store');
    });

});
