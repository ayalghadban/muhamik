<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;



Auth::routes();
Route::post('/login', [LoginController::class,'login']);
Route::group(['middleware' => ['auth:sanctum', 'ability:admin']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('home');

});
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');