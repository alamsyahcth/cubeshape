<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Models\Backend\Quiz;
use App\Models\Backend\Question;
use App\Models\Backend\QuestionOption;
use App\Models\Player;
use Session;

class PlayerQuizController extends Controller {
    
    public function index() {
        if (Session::get('token') == null && Session::get('idPlayer')) {
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

    public function storeQuestion(Request $request) {
        $data = Player::where('id', Session::get('idPlayer'))->update([
            'score' => $request->score,
            'status' => 1
        ]);
        if($data) {
            return response()->json([
                'succes' => true,
                'id' => Session::get('idPlayer')
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'id' => false,
            ], 401);
        }
    }

    public function result() {
        if (Session::get('idPlayer') == null) {
            return redirect('/');
        }
        Session::forget('token');
        $data = Player::where('id', Session::get('idPlayer'))->first();
        $quiz = Question::where('quiz_id', Crypt::decryptString(Session::get('quizId')))->where('status', 1)->count();
        return view('frontend.result.index', compact(['data', 'quiz']));
    }

}
