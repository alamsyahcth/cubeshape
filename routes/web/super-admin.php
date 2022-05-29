<?php

Route::group(['prefix' => 'super-admin', 'as' => 'super-admin.'], function () {
  Route::get('/', function() { return view('backend.super-admin.dashboard.index'); });

  Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('user');
    Route::get('/{id}', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [App\Http\Controllers\Backend\UserController::class, 'update'])->name('user.update');
    Route::get('/delete/{id}', [App\Http\Controllers\Backend\UserController::class, 'destroy'])->name('user.delete');
  });
});

