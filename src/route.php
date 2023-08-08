<?php

namespace App;

use App\Controller\UserController;
use App\Extend\Route;

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/create', [UserController::class, 'create']);
Route::post('/store', [UserController::class, 'store'])->name('user.store');

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('find', [UserController::class, 'index'])->name('find');
    Route::get('/show', [UserController::class, 'index'])->name('show');
});