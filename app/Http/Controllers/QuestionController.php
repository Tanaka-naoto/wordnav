<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function index(Request $request) {

        $defaults = [
            'category' => $request->input('category'),
            'keyword'  => $request->input('keyword', ''),
        ];

        $categorys = Category::all();
        $questions = Question::latest()->get();


         //カテゴリがありつつキーワードもある場合
         if($request->filled('category') && $request->filled('keyword')) {
            $categoryID = $request->input('category');
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';

            $questions = Question::where('category_id', $categoryID)->where('before_word', 'LIKE', $keyword)->orWhere('background', 'LIKE', $keyword)->latest()->get();


            //カテゴリのみある場合
        } else if($request->filled('category')) {

            $categoryID = $request->input('category');
            $questions = Question::where('category_id', $categoryID)->latest()->get();


            //キーワードのみある場合
        } else if($request->filled('keyword')) {

            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $questions = Question::where('before_word', 'LIKE', $keyword)->orWhere('background', 'LIKE', $keyword)->latest()->get();

        }

        return view('question.index',compact('questions','categorys','defaults'));
    }

    private function escape(string $value)
     {
         return str_replace(
             ['\\', '%', '_'],
             ['\\\\', '\\%', '\\_'],
             $value
         );
     }


    public function show(Question $question ) {

        $answers = Answer::where('question_id', $question->id)->withCount('users')->orderBy('users_count', 'desc')->paginate();
        $most_like_answer = Answer::where('question_id', $question->id)->withCount('users')->orderBy('users_count', 'desc')->first();

        // dd($answers);
        return view('question.show', compact('question', 'answers','most_like_answer'));

    }

    public function create() {

        $categorys = Category::all();
        return view('question.create',compact('categorys'));
    }

    public function store(QuestionRequest $request) {

        $user = Auth::user();
        $question = new Question();

        $question->user_id = $user->id;
        $question->before_word = $request->input('before_word');
        $question->background = $request->input('background');
        $question->category_id = $request->input('category');
        $question->save();

        return redirect()
            ->route('question.index');
    }

    public function edit(Question $question) {

        $this->authorize('update', $question);

        $categorys = Category::all();
        return view('question.edit',compact('question', 'categorys'));
    }

    public function update(QuestionRequest $request, Question $question) {

        $this->authorize('update', $question);

        $question->before_word = $request->input('before_word');
        $question->background = $request->input('background');
        $question->category_id = $request->input('category');
        $question->update();

        return redirect()
            ->route('question.show', $question)
            ->with('message', '質問を更新しました');

    }

    public function destroy(Question $question){

        $this->authorize('delete', $question);

        $question->answers()->delete();
        $question->delete();

        return redirect()
            ->route('question.index')
            ->with('message', '質問を削除しました');
    }


 }
