<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Category;


class AnswerController extends Controller
{
    public function create(Question $question) {

        return view('question.answer',compact('question'));
    }

    public function store(AnswerRequest $request, Question $question) {

        $user = Auth::user()->id;
        $answer = new Answer();

        $answer->user_id = $user;
        $answer->question_id = $question->id;
        $answer->after_word = $request->input('after_word');
        $answer->description = $request->input('description');
        $answer->save();

        return redirect()
            ->route('question.show', compact('question', 'user'))
            ->with('message', '質問に回答しました');

    }

    public function best_answer_store(Answer $answer)
    {
        $question = $answer->question;

        $answer->best_answer_id = $question->id;
        $answer->update();

            return redirect()
                ->route('question.show', $question)
                ->with('message', 'ベストアンサーをえらびました');
    }


}
