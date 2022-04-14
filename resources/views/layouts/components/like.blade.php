<div class="about" style="display: flex">
    @if($answer->users()->where('user_id', Auth::id())->exists())
    <!--いいねを外す処理-->
    <div>
        <form method="post" action="{{ route('answer.unfavorites', $answer) }}">
            @csrf

            <input type="submit" value="&#xf004;" class="fas fa-heart pr-2" style="background: none; border: none; color: rgb(243, 61, 91)">

        </form>
    </div>

    @else<!--いいねをする処理-->
    <div>
        <form method="post" action="{{ route('answer.favorites', $answer) }}">
            @csrf

            <input type="submit" value="&#xf004;" class="fas fa-heart pr-2" style="background: none; border: none; color: gray">

        </form>
    </div>

    @endif

        <div>{{$answer->users()->count()}}</div>
</div>
