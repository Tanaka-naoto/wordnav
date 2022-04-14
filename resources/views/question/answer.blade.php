@extends('layouts.app')

@section('content')

<section>
    <div class="container py-5">
        <div class="row text-center align-items-end">

            <div class="col-lg-12 mb-5 mb-lg-0">

                    <div class="bg-white p-5 rounded-lg shadow" style="text-align: left">
                        <div style="text-align: left; display: inline-block; background-color: var(--bs-orange); padding: 0px 2%; border-radius: 5px; margin-bottom: 2%; color: white">{{$question->category->name}}</div>

                            <h1 class="h6 text-uppercase font-weight-bold mb-4">{{$question->background}}</h1>
                            <div>言い換えたい言葉</div>
                            <h2 class="h1 font-weight-bold" style="text-align: center">{{$question->before_word}}</h2>
                            <div class="custom-separator my-4 mx-auto bg-warning"></div>

                        <form method="post" action="{{route('answer.store', $question)}}">
                        @csrf
                            <div class="form-group" style="margin-block: 2%">
                                <label for="after_word">言い変え後の言葉</label>
                                <input type="text" name="after_word" class="form-control" id="after_word" placeholder="Enter after_word" value="{{old('after_word')}}">
                            </div>

                            <div class="form-group">
                                <label for="description">補足説明</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{old('description')}}</textarea>
                            </div>

                            <button class="btn btn-warning btn-block p-2 shadow rounded-pill" style="margin-top: 2%; background: #ff6a00;">回答する</button>
                        </form>
                    </div>

            </div>

        </div>
    </div>
</section>

@endsection

