<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    $active = 1;
    $total = 0;
    $theCheck = 0;
    $products = array();
    $members = array();

    $event = Event::query()->where('status', '=', $active)->first();
    $memberCount = $event->member->count();
    foreach ($event->product as $e) {
        $products[] = $e;
        $total += $e->price;
    }
    if ($memberCount > 0) {
        $theCheck = $total / $memberCount;
    }
    foreach ($event->member as $m){
        $members[] = $m;
    }

    $total = number_format((float)$total, 2, '.', ',');
    $theCheck = number_format((float)$theCheck, 2, '.', ',');

    return view('welcome', compact('event', 'products', 'total', 'theCheck', 'members'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Only authenticated users may access this route...
    Route::prefix('event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/', [EventController::class, 'store'])->name('events.store');
    });
    Route::prefix('member')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('members.index');
        Route::get('/create', [MemberController::class, 'create'])->name('members.create');
        Route::post('/', [MemberController::class, 'store'])->name('members.store');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
    });

});
