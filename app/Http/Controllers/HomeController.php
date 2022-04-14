<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function myanswer(Request $request, User $user) {

        $user_id = $user->id;
        $categorys = Category::all();
        $my_answerd_questions = Question::where('user_id', $user_id)->get();


    return view('mypage.answer', compact('my_answerd_questions', 'categorys'));
    }



}
