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

class HistoryController extends Controller {
    
    protected $path = 'history';
    protected $role = 'admin';

    public function index() {
        $data = Quiz::where('user_id', Auth::user()->id)->get();
        $page = $this->path;
        return view('backend.'.$this->role.'.'.$this->path.'.index', compact(['page', 'data']));
    }

    public function classement($id) {
        $data = Quiz::where('id', Crypt::decryptString($id))->first();
        $players = Player::where('quiz_id', Crypt::decryptString($id))->orderBy('score', 'DESC')->get();
        $page = $this->path;
        $dataId = $id;
        return view('backend.'.$this->role.'.'.$this->path.'.classement', compact(['page', 'data', 'players', 'dataId']));
    }

    public function topThree($id) {
        $players = Player::where('quiz_id', Crypt::decryptString($id))->orderBy('score', 'DESC')->limit(3)->get();
        $res = [
            'success' => true,
            'data' => $players
        ];

        return response()->json($res);
    }

}
