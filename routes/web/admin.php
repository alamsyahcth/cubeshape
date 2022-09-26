<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/', function() { return redirect('admin/quiz'); });

  Route::group(['prefix' => 'quiz', 'as' => 'quiz.'], function () {
    Route::get('/', [App\Http\Controllers\Backend\QuizController::class, 'newQuiz'])->name('quiz');
    Route::post('/create', [App\Http\Controllers\Backend\QuizController::class, 'createQuiz'])->name('quiz.create');
    Route::get('/all', [App\Http\Controllers\Backend\QuizController::class, 'allQuizzes'])->name('quiz.all');
    Route::get('/{id}', [App\Http\Controllers\Backend\QuizController::class, 'startQuiz'])->name('quiz.start-quiz');
    Route::get('/start-quiz/{id}', [App\Http\Controllers\Backend\QuizController::class, 'start'])->name('quiz.start');
    Route::get('/stop-quiz/{id}', [App\Http\Controllers\Backend\QuizController::class, 'stop'])->name('quiz.stop');

    Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
      Route::get('/{id}', [App\Http\Controllers\Backend\QuizController::class, 'questions'])->name('quiz.questions');
      Route::post('/create', [App\Http\Controllers\Backend\QuizController::class, 'createQuestionOptions'])->name('quiz.questions.create');
      Route::post('/update', [App\Http\Controllers\Backend\QuizController::class, 'updateQuestionOptions'])->name('quiz.questions.update');
      Route::get('/delete/{id}', [App\Http\Controllers\Backend\QuizController::class, 'deleteQuestion'])->name('quiz.questions.delete');
      Route::get('/get-question-option/{id}', [App\Http\Controllers\Backend\QuizController::class, 'getQuestionOptions'])->name('quiz.questions.get-question-options');
    });
  });

  Route::group(['prefix' => 'history', 'as' => 'history.'], function () {
    Route::get('/', [App\Http\Controllers\Backend\HistoryController::class, 'index'])->name('history.index');
    Route::get('/{id}', [App\Http\Controllers\Backend\HistoryController::class, 'classement'])->name('history.index.classement');
    Route::get('/classement/{id}', [App\Http\Controllers\Backend\HistoryController::class, 'topThree'])->name('history.index.topThree');
  });

});