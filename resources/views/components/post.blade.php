
    <div class="card w-100 mb-3">
        <div class="card-body">
            <div class="row">
            <div class="col-10">

            <h3 class="card-title">{{ $post->title }}</h3>
            </div>
                <div class="col-2">
                    @auth
                          @if($post->user->id == Auth::user()->id)
                            <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button type="submit" class="btn text-muted"><i class="far fa-trash-alt"></i></button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        <div class="card-subtitle pb-3 mb-3 border-bottom">
                <a href="{{ route('profileWithUsername', ['username' => $post->user->username]) }}">{{ $post->user->username }}</a> at <span class="text-muted">{{ $post->created_at }}</span>
            </div>
            <p class="card-text pb-3 mb-3 border-bottom">{{ $post->content }}</p>
            <div class="card-text pb-3 mb-3 border-bottom">
                <div class="row">
                    <div class="col text-center">
                        <a class="text-dark" href="#"><i class="far fa-comment"></i></a>
                    </div>
                    <div class="col text-center">
                        <a class="text-dark" href="#"><i class="far fa-heart"></i></a>
                    </div>
                    <div class="col text-center">
                        <a class="text-dark" href="#"><i class="far fa-bookmark"></i></a>
                    </div>
                </div>
            </div>
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
            @auth
            <form method="post" action="{{ route('comment', ['id' => $post->id]) }}">
                @csrf
                <div class="form-row">
                    <div class="col-8 col-sm-10">
                        <textarea name="content" id="content" rows="2" class="form-control" placeholder="Add a comment..."></textarea>
                    </div>
                    <div class="col-4 col-sm-2">
                        <button class="btn btn-block h-100 btn-outline-success" type="submit">Send</button>
                    </div>

                </div>
            </form>
            @endauth
        </div>
    </div>
