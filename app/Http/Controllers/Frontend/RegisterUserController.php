<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Player;
use App\Models\Backend\Quiz;
use Session;
use DB;

class RegisterUserController extends Controller {
    
    public function index() {
        if (Session::get('token') != null) {
            return redirect('/waiting-game');
        } else {
            return view('frontend.register-user.index');
        }
    }

    public function enterPin(Request $request) {

        $validate = $this->validate($request, [
            'pin' => 'required|digits:5|numeric'
        ]);

        if ($validate) {
            $global = Quiz::where('pin', $request->pin)->where('status', 2);
            $count = $global->count();
            if($count == 1) {
                $data = $global->first();
                Session::put('quizId', Crypt::encryptString($data->id));
                Session::put('quizName', $data->name);
                Session::put('quizPIN', Crypt::encryptString($data->pin));
                notify()->success('Yeayy, Your PIN is correct');
                return redirect('enter-name');
            } else {
                notify()->error('Your room is not Available');
                return redirect('/');
            }
        }
    }

    public function enterName() {
        if (Session::get('token') != null) {
            return redirect('/waiting-game');
        } else {
            return view('frontend.enter-username.index');
        }
    }

    public function registerPlayer(Request $request) {

        $validate = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phoneNumber' => 'required|numeric'
        ]);

        if ($validate) {
            DB::beginTransaction();
            try{
                $data = new Player;
                $data->quiz_id = Crypt::decryptString(Session::get('quizId'));
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phoneNumber;
                $data->score = 0;
                $data->rank = 0;
                $data->status = 0;
                $data->save();
                DB::commit();
                Session::put('idPlayer', $data->id);
                Session::put('token', Str::random(32));
                return redirect('waiting-game');
            } catch (\Exception $err) {
                DB::rollback();
                notify()->error('Sorry your data cant created, please try again');
                return redirect('enter-name');
            }
        }
    }

    public function waitingGame() {
        if (Session::get('token') == null && Session::get('idPlayer') == null) {
            return redirect('/');
        } else {
            $data = Quiz::where('id', Crypt::decryptString(Session::get('quizId')))->first();
            return view('frontend.waiting-game.index', compact('data'));
        }
    }

}
