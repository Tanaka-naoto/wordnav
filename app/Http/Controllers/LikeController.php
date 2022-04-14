<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
class LikeController extends Controller
{
    public function store(Answer $answer) {
        // $message = 'いいねぼたんがおされました';
        // dd($message);
        $answer->users()->attach(Auth::id());
        return back()->with('message', 'いいねをしました。');
    }

    public function destroy(Answer $answer) {

        $answer->users()->detach(Auth::id());
        return back();
    }
}
