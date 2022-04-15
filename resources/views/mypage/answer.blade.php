@extends('layouts.app')

@section('content')


    @if(session('message'))

    <div class="alert alert-success">{{session('message')}}</div>
    @endif

<section>
    <div class="container py-5">

        {{-- 回答した質問一覧 --}}
    <div class="row text-center align-items-start">
            @foreach ($my_answerd_questions->unique('question_id') as $my_answerd_question)

            <?php
                $my_answerd_question = $my_answerd_question->question;
            ?>
            <div class="col-lg-4 mb-5 mb-lg-5">
                <a href="{{ route('question.show', $my_answerd_question) }}" style="text-decoration: none; color: black">
                    <div class="bg-white p-5 rounded-lg shadow" style="text-align: left">

                        <div style="text-align: left;
                        display: inline-block;
                        background-color: var(--bs-orange);
                        padding: 0px 2%;
                        border-radius: 5px;
                        color: white;
                        margin-bottom: 2%">{{$my_answerd_question->category->name}}</div>
                        <h1 class="h6 end text-uppercase font-weight-bold my-4">{{($my_answerd_question->background)}}</h1>
                        <div>言い換えたい言葉</div>
                        <h2 class="h1 end font-weight-bold" style="text-align: center">{{$my_answerd_question->before_word}}</h2>

                        <svg style="margin: 0 auto; width: 20%" class="my-4 d-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.61 38.76"><defs><style>.cls-1{fill:#f5bb1c;}</style></defs><g id="レイヤー_2" data-name="レイヤー 2"><g id="レイヤー_1-2" data-name="レイヤー 1"><polygon class="cls-1" points="23.61 19.73 11.81 38.76 0 19.73 6.59 19.73 6.59 0 17.02 0 17.02 19.73 23.61 19.73"/></g></g></svg>
                        <ul class="list-unstyled my-5 text-small text-left">

                            @if($my_answerd_question->best_answer()->where('best_answer_id', $my_answerd_question->id)->exists())
                            <i class="fa fa-check mr-2 text-primary"></i><label for="">ベストアンサー</label>
                            <li class="h1 end text-uppercase font-weight-bold mt-3">
                                {{{$my_answerd_question->best_answer->after_word}}}
                            </li>
                            @else
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i>
                                ベストアンサーがまだありません
                            </li>
                            @endif
                        </ul> <a href="{{ route('question.show', $my_answerd_question) }}" class="btn btn-warning btn-block p-2 shadow rounded-pill" style="display:block;">詳細を見る</a>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </div>
    <a href="{{ route('question.create', $my_answerd_question) }}">
        <button class="btn btn-primary  shadow rounded-pill" style="position: fixed; bottom: 1%; right: 1%; padding: 2%">
            質問する
        </button>
    </a>

</section>

@endsection

