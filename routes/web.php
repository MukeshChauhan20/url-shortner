<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('url')->name('url.')->middleware('auth')->group(function(){
    Route::post('store',[App\Http\Controllers\UrlController::class,'store'])->name('store');
    Route::get('edit/{url}',[App\Http\Controllers\UrlController::class,'edit'])->name('edit');
    Route::post('update/{url}',[App\Http\Controllers\UrlController::class,'update'])->name('update');
    Route::get('remove/{url}',[App\Http\Controllers\UrlController::class,'destroy'])->name('destroy');
    Route::post('update-plans',[App\Http\Controllers\UrlController::class,'updatePackage'])->name('update.plans');
});