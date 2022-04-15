@extends('layouts.app')

@section('content')




    {{-- <div>{{$question->category_id}}</div> --}}

    @if(session('message'))

    <div class="alert alert-success">{{session('message')}}</div>
    @endif

<section>
    <div class="container py-5">

        <form class="form-inline" method="GET" action="">
            <div class="input-group">
                <div class="input-group-prepend" style="display: flex">
                    <select class="custom-select" name="category">
                        <option option value="">全て</option>
                        @foreach ($categorys as $category)
                           <option value="{{$category->id}}" class="font-weight-bold" {{ $defaults['category'] == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" name="keyword" value="{{ $defaults['keyword']}}" class="form-control" aria-label="Text input with dropdown button" placeholder="キーワード検索">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-dark">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form><br>

        {{-- 質問一覧 --}}
    <div class="row  align-items-start">
            @foreach ($questions as $question)
            <div class="col-lg-4 mb-5 mb-lg-5">
                <a href="{{ route('question.show', $question) }}" style="text-decoration: none; color: black">
                    <div class="bg-white p-5 rounded-lg shadow" style="">

                        <!-- for分でカテゴリ別の色を変更-->
                        @for ($i = 1; $i <= 6; $i++)
                            @if($question->category_id == $i)
                                <div class="category_sype" id="<?php echo "category_color".$i; ?>">
                                    {{$question->category->name}}
                                </div>
                            @endif
                        @endfor



                        <div class="desc_back">
                            <div style="border-bottom: 1px solid black; display: inline-block">いきさつ</div>
                        <h1 class="h6 end text-uppercase font-weight-bold my-4">{!! nl2br(e($question->background)) !!}</h1>
                        </div>


                        <div>言い換えたい言葉</div>
                        <h2 class="text-uppercase end font-weight-bold my-4">{{$question->before_word}}</h2>

                        <svg style="margin: 0 auto; width: 20%" class="my-4 d-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.61 38.76"><defs><style>.cls-1{fill:#f5bb1c;}</style></defs><g id="レイヤー_2" data-name="レイヤー 2"><g id="レイヤー_1-2" data-name="レイヤー 1"><polygon class="cls-1" points="23.61 19.73 11.81 38.76 0 19.73 6.59 19.73 6.59 0 17.02 0 17.02 19.73 23.61 19.73"/></g></g></svg>
                        <ul class="list-unstyled mb-5 text-small text-left">

                            @if($question->best_answer()->where('best_answer_id', $question->id)->exists())

                            <i class="fa fa-check mr-2 text-primary"></i><label>ベストアンサー</label>
                            <li class="h1 end font-weight-bold mt-3" style="text-align: center">
                                {{$question->best_answer->after_word}}</li>
                            @else
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i>
                                ベストアンサーがまだありません
                            </li>
                            @endif
                        </ul> <a href="{{ route('question.show', $question) }}" class="btn btn-warning btn-block p-2 shadow rounded-pill" style="display:block;">詳しく見える</a>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </div>
    <a href="{{ route('question.create') }}">
        <button class="btn btn-primary  shadow rounded-pill" style="position: fixed; bottom: 1%; right: 1%; padding: 2%;">
            質問する
        </button>
    </a>

</section>

@endsection

