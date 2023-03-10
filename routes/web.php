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

    $eventActive = (new EventController())->eventActive();
    if ($eventActive) {
        $memberCount = $eventActive->member->count();

        foreach ($eventActive->product as $e) {
            $products[] = $e;
            $total += $e->price;
        }
        if ($memberCount > 0) {
            $theCheck = $total / $memberCount;
        }
        foreach ($eventActive->member as $m) {
            $members[] = $m;
        }
    }
    
        (new EventController())->addTheCheck($total, $eventActive);

    $theCheck = number_format((float)$theCheck, 2, '.', ',');

    return view('welcome', compact('eventActive', 'products', 'total', 'theCheck', 'members'));
})->name('main');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Only authenticated users may access this route...
    Route::prefix('event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::post('/', [EventController::class, 'store'])->name('events.store');
        Route::put('/', [EventController::class, 'changeStatus'])->name('events.change');
        Route::put('/update', [EventController::class, 'update'])->name('events.update');
    });
    Route::prefix('member')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('members.index');
        Route::post('/', [MemberController::class, 'store'])->name('members.store');
        Route::put('/{member}/', [MemberController::class, 'update'])->name('members.update');
        Route::put('/update/payment',[MemberController::class,'updatePaymentStatus'])->name('members.update.payment');
        Route::delete('/{member}/', [MemberController::class, 'destroy'])->name('members.destroy');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::put('/{product}/', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}/', [ProductController::class, 'destroy'])->name('products.destroy');
    });

});
