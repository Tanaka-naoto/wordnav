@extends('layouts.app')

@section('content')

@if(session('message'))

    <div class="alert alert-success">{{session('message')}}</div>

@endif

<section>
    <div class="container py-5">

        <div class="row text-center align-items-end">

            <div class="col-lg-12 mb-5 mb-lg-5">

                    <div class="bg-white p-5 rounded-lg shadow" style="text-align: left">

                        <div class="wrpdes" style="display: flex; align-items: center; margin-bottom: 3%">
                            <div style="text-align: left; display: inline-block; background-color: var(--bs-orange); padding: 0px 2%; border-radius: 5px; color: white;">{{$question->category->name}}</div>

                        <div class="function_wrp" style="display: flex; margin-left: auto">

                            @can('update', $question)  @if(!$question->best_answer)
                            <a href="{{ route('question.edit', $question) }}">
                                <button class="btn btn-success">編集</button>
                            </a>
                            @endcan
                            @endif

                            @can('delete', $question)
                            <form method="post" action="{{ route('question.destroy', $question) }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('本当に削除しますか？')" style="margin-left: 10px">削除</button>
                            </form>
                            @endcan
                        </div>
                        </div>


                        <h1 class="h6 text-uppercase font-weight-bold my-4">{!! nl2br(e($question->background)) !!}</h1>

                        <div>言い換えたい言葉</div>

                        <h2 class="h1 font-weight-bold" style="text-align: center">{{$question->before_word}}</h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled mt-5 text-small text-left">

                            @if($most_like_answer)
                            <label for="">いいね1位</label>

                                    <li class="h1 font-weight-bold mb-3" style="text-align: center">
                                    <i class="fa fa-check mr-2 text-primary"></i>
                                        {{$most_like_answer->after_word}}
                                    </li>
                            @else
                                <li class="mb-3">
                                    まだいいね1位はありません
                                </li>
                            @endif

                            @if($question->best_answer)
                            <label for="">ベストアンサー</label>
                                <li class="h1 font-weight-bold" style="text-align: center">
                                    <i class="fa fa-check mr-2 text-primary"></i>
                                    {{$question->best_answer->after_word}}
                                </li>
                            @else
                                <li>
                                    まだベストアンサーはありません
                                </li>
                            @endif
                        </ul>

                        <a href="{{ route('answer.create', $question) }}" class="btn btn-warning btn-block p-2 shadow rounded-pill" style="position: fixed; right: 2%; bottom: 2%; background-color:#f34c54">回答する</a>
                    </div>
            </div>
        </div>

        <!-- 回答コメント-->

        @foreach ($answers as $answer)

        <div class="row text-center align-items-end iine">

            <div class="col-lg-12 mb-5 mb-lg-5">

                    <div class="bg-white p-5 rounded-lg shadow number" style="text-align: left">
                        @if($answer->best_answer_id)
                        <div class="best_answer">ベストアンサー</div>
                        @endif


                             <!-- いいね処理-->
                             @include('../layouts/components/.like',[
                                'question' => $question
                            ])


                            <div>言い換えたい言葉</div>
                            <h2 class="h1 font-weight-bold" style="text-align: center">{{$question->before_word}}</h2>
                            <div class="custom-separator my-4 mx-auto bg-warning"></div>

                        <form method="post" action="{{route('answer.store', $question)}}">
                        @csrf

                                <label for="after_word">言い変え後の言葉</label>

                                <h2 class="h1 font-weight-bold" style="text-align: center">{{$answer->after_word}}</h2>

                                <h1 class="h6 text-uppercase font-weight-bold my-4">{{$answer->description}}</h1>

                        </form>


                        @if(!$question->best_answer()->where('best_answer_id', $question->id)->exists() && $question->user_id == Auth::id())

                            <form method="post" action="{{ route('answer.best_answer', $answer) }}">
                                @csrf
                                @method('put')

                                <button type="submit" class="btn btn-warning btn-block p-2 shadow rounded-pill" onclick="return confirm('ベストアンサー選択後は質問の編集はできません')" style="background: #4689ed;">ベストアンサーにする</button>

                            </form>
                        @endif

                    </div>
            </div>
        </div>

        @endforeach
    </div>
</section>

@endsection

