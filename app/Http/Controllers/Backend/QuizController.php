<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Backend\Quiz;
use App\Models\Backend\Question;
use App\Models\Backend\QuestionOption;
use App\Models\Player;
use Auth;
use DB;
use Carbon\Carbon;

class QuizController extends Controller {
    
    protected $path = 'quiz';
    protected $role = 'admin';

    public function newQuiz() {
        $page = $this->path;
        return view('backend.'.$this->role.'.'.$this->path.'.new-quiz', compact(['page']));
    }

    public function createQuiz(Request $request) {
        $validate = $this->validate($request, [
            'quizName' => 'required',
            'quizDescription' => 'required',
            'quizTimeMinute' => 'required|numeric',
            'quizTimeSecond' => 'required|numeric',
        ]);
        if ($validate) {
            DB::beginTransaction();
            try{
                $data = new Quiz;
                $data->user_id = Auth::user()->id;
                $data->date = Carbon::today()->toDateString();
                $data->name = $request->quizName;
                $data->description = $request->quizDescription;
                $data->status = 1;
                $data->minute = $request->quizTimeMinute;
                $data->second = $request->quizTimeSecond;
                $data->pin = $this->generatePin();
                $data->save();
                DB::commit();
                notify()->success('Quiz has been created');
                return redirect($this->role.'/'.$this->path);
            } catch (\Exception $err) {
                DB::rollback();
                notify()->error('Quiz cant created');
                return redirect($this->role.'/'.$this->path);
            }
        }
    }

    protected function generatePin() {
        $pin = rand(10000, 99999);
        if (Quiz::where('pin', $pin)->exists()) {
            return generatePin();
        } else {
            return $pin;
        }
    }

    public function allQuizzes() {
        $data = Quiz::where('user_id', Auth::user()->id)->get();
        $page = $this->path;
        return view('backend.'.$this->role.'.'.$this->path.'.all-quiz', compact(['data', 'page']));
    }

    public function questions($id) {
        $decryptId = Crypt::decryptString($id);
        $data = Quiz::where('id', $decryptId)->first();
        $questions = Question::where('quiz_id', $decryptId)->get();
        $questionOptions = QuestionOption::get();
        $page = $this->path;
        $secondPage = 'questions';
        return view('backend.'.$this->role.'.'.$this->path.'.questions', compact(['data', 'questions', 'questionOptions', 'page', 'secondPage']));
    }

    public function getQuestionOptions($id) {
        $data = QuestionOption::where('question_id', $id)->get();
        if ($data) {
            $res = [
                'success' => true,
                'data' => $data,
            ];
            return response()->json($res);
        }
    }

    public function createQuestionOptions(Request $request) {
        $validate = $this->validate($request, [
            'questionTitle' => 'required'
        ]);
        if($validate) {
            try{
                $data = new Question;
                $data->quiz_id = $request->quizId;
                $data->title = $request->questionTitle;
                $data->status = 1;
                
                if ($data->save()) {
                    for($i = 0; $i < 4; $i++) {
                        $question = new QuestionOption;
                        $question->question_id = $data->id;
                        $question->option = $request->option[$i];
                        $question->is_true = $request->answer[$i];
                        $question->save();
                    }

                    Quiz::where('id', $request->quizId)->update(['status' => 2]);

                    notify()->success('Quiz created has been success');
                    return redirect($this->role.'/'.$this->path.'/questions/'.Crypt::encryptString($request->quizId));
                }
            } catch (\Exception $err) {
                notify()->error('Quiz cant created');
                return redirect($this->role.'/'.$this->path.'/questions/'.Crypt::encryptString($request->quizId));
            }
        }
    }

    public function updateQuestionOptions(Request $request) {
        $validate = $this->validate($request, [
            'questionTitle' => 'required'
        ]);
        if($validate) {
            $data = Question::find($request->questionId);
            $data->quiz_id = $request->quizId;
            $data->title = $request->questionTitle;
            $data->status = 1;

            if($data->save()) {
                for($i = 0; $i < 4; $i++) {
                    $question = QuestionOption::find($request->optionId[$i]);
                    $question->question_id = $request->questionId;
                    $question->option = $request->option[$i];
                    $question->is_true = $request->answer[$i];
                    $question->save();
                }
            }

            notify()->success('Quiz created has been success');
            return redirect($this->role.'/'.$this->path.'/questions/'.Crypt::encryptString($request->quizId));
        }
    }

    public function deleteQuestion($id) {
        $data = Question::where('id', $id)->first();
        if ($data->delete()) {
            notify()->success('Question has been delete');
            return redirect(app('url')->previous());
        }
    }

    public function startQuiz($id) {
        $data = Quiz::where('id', Crypt::decryptString($id))->first();
        $players = Player::where('quiz_id', Crypt::decryptString($id))->get();
        $page = $this->path;
        return view('backend.'.$this->role.'.'.$this->path.'.start', compact(['page', 'data', 'players']));
    }

    public function start($id) {
        $data = Quiz::where('id', Crypt::decryptString($id))->update([
            'status' => 3
        ]);
        if($data) {
            return $this->startQuiz($id);
        }
    }
}
