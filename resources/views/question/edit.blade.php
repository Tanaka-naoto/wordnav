
@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">新規投稿</h1>
            <form method="post" action="{{route('question.update', $question)}}">
                @csrf
                @method('put');

                <div class="form-group">
                    <label for="before_word">言い変えたい言葉</label>
                    <input type="text" name="before_word" class="form-control" id="title" placeholder="Enter Title" value="{{old('before_word', $question->before_word)}}">
                </div>

                <div class="form-group">
                    <label for="background">いきさつ</label>
                    <textarea name="background" class="form-control" id="background" cols="30" rows="10">{{old('background', $question->background)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category">カテゴリー</label>
                        <select name="category" class="form-control" id="" >
                            @foreach ($categorys as $category)

                                <option value="{{$category->id}}"{{old('category',$question->category->name)}}>{{$category->name}}</option>

                            @endforeach
                        </select>
                </div>

                <button type="submit" class="btn btn-success">送信する </button>
            </form>
        </div>
    </div>
</div>
@endsection
