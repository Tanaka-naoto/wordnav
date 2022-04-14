
@extends('layouts.app')

@section('content')

<div class="row" style="width: 100%">
    <div class="col-md-10 mt-6" style="margin: 0 auto">
        <div class="card-body" style="">
            <h1 class="mt4">新しい質問</h1>
            <form method="post" action="{{route('question.store')}}">
                @csrf

                <div class="form-group mb-3">
                    <label for="before_word">言い変えたい言葉</label>
                    <input type="text" name="before_word" class="form-control" id="title" placeholder="Enter Title" value="{{old('title')}}">
                </div>

                <div class="form-group mb-3">
                    <label for="background">いきさつ・内容・改善したい方向性など</label>
                    <textarea name="background" class="form-control" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="category">カテゴリー</label>
                        <select name="category" class="form-control" id="" >
                            @foreach ($categorys as $category)

                                <option value="{{$category->id}}"{{old('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>

                            @endforeach
                        </select>
                </div>

                <button type="submit" class="btn btn-primary">送信する </button>
            </form>
        </div>
    </div>
</div>
@endsection
