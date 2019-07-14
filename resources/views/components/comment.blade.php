<div class="row">
    <div class="col">
        <a class="text-dark" href="{{ route('profileWithUsername', ['username' => $comment->user->username]) }}"><strong>{{ $comment->user->username }}</strong></a> {{ $comment->content }}
    </div>
</div>