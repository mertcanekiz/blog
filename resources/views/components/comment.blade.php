<div class="row comment pr-3">
    <div class="col pr-0">
        <a href="{{ route('profileWithUsername', ['username' => $comment->user->username]) }}"><strong>{{ $comment->user->username }}</strong></a> {{ $comment->content }}
    </div>
    <div class="delete-form" id="delete-form-{{$comment->id}}">
        @if($comment->user->id == Auth::user()->id)
            <form method="post" action="{{ route('deleteComment', ['id', $comment->text_post->id]) }}">
                @csrf
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <a href="#" class="delete-comment-link">Delete</a>
            </form>
        @endif
    </div>
</div>