
    <div class="card w-100 mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <a href="{{ route('profileWithUsername', ['username' => $post->user->username]) }}"><h6 class="card-subtitle mb-2 text-muted">{{ $post->user->username }}</h6></a>
            <p class="card-text pb-3 border-bottom">{{ $post->content }}</p>
            <h5>Comments</h5>
            <div class="mb-3" id="comments">
                @if(count($post->comments) == 0)
                    <span class="text-muted">No comments yet</span>
                @else
                    @foreach($post->comments as $comment)
                        @component('components.comment', ['comment' => $comment])
                        @endcomponent
                    @endforeach
                @endif
            </div>
            <form method="post" action="{{ route('comment', ['id' => $post->id]) }}">
                @csrf
                <div class="form-row">
                    <div class="col-9 col-sm-10">
                        <textarea name="content" id="content" rows="2" class="form-control" placeholder="Add a comment..."></textarea>
                    </div>
                    <div class="col-3 col-sm-2">
                        <button class="btn btn-block h-100 btn-outline-success" type="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>

        {{ $slot }}
    </div>
