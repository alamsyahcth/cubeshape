<?php

Route::get('/', [App\Http\Controllers\Frontend\RegisterUserController::class, 'index']);
Route::post('/enter-pin', [App\Http\Controllers\Frontend\RegisterUserController::class, 'enterPin'])->name('enter-pin');
Route::get('/enter-name', [App\Http\Controllers\Frontend\RegisterUserController::class, 'enterName'])->name('enter-name');
Route::post('/register-player', [App\Http\Controllers\Frontend\RegisterUserController::class, 'registerPlayer'])->name('register-player');
Route::get('/waiting-game', [App\Http\Controllers\Frontend\RegisterUserController::class, 'waitingGame'])->name('waiting-game');
Route::get('/quiz', [App\Http\Controllers\Frontend\PlayerQuizController::class, 'index'])->name('index');
Route::post('/store-question', [App\Http\Controllers\Frontend\PlayerQuizController::class, 'storeQuestion'])->name('store-question');
Route::get('/result', [App\Http\Controllers\Frontend\PlayerQuizController::class, 'result'])->name('result');