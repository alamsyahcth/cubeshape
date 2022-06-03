<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Models\Backend\Quiz;
use App\Models\Backend\Question;
use App\Models\Backend\QuestionOption;
use Session;

class PlayerQuizController extends Controller {
    
    public function index() {
        if (Session::get('token') == null) {
            return redirect('/');
        }
        $getQuiz = Quiz::where('id', Crypt::decryptString(Session::get('quizId')))->first();
        $getQuestion = Question::where('quiz_id', Crypt::decryptString(Session::get('quizId')))->get();
        $getQuestionOption = QuestionOption::join('questions','questions.id','=','question_options.question_id')->where('questions.quiz_id','=',Crypt::decryptString(Session::get('quizId')))->get();
        $limit = $getQuiz->time;
        $minuteAdd = $getQuiz->minute;
        $secondAdd = $getQuiz->second;
        $now = Carbon::now();
        $dataNow = Carbon::createFromFormat('Y-m-d H:i:s', $now);
        $dataEnd = Carbon::createFromFormat('Y-m-d H:i:s', $limit)->addMinutes($minuteAdd)->addSeconds($secondAdd);
        $limit = $now->diffInSeconds($dataEnd);
        $minute = Carbon::parse($limit)->format('i');
        $second = Carbon::parse($limit)->format('s');
        if ($dataNow >= $dataEnd || $minuteAdd < $minute) {
            $show = null;
        } else {
            $show = ($minute * 60) + $second;
        }
        return view('frontend.quiz.index', compact('show','getQuestion','getQuestionOption'));

    }

    public function result() {
        return view('frontend/result/index.blade.php');
    }

}
