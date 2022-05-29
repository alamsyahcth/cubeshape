<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerQuizController extends Controller {
    
    public function index() {
        return view('frontend.quiz.index');
    }

    public function result() {
        return view('frontend/result/index.blade.php');
    }

}
