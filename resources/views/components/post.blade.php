
    <div class="card w-100 mb-3" id="post-{{$post->id}}">
        <div class="card-body">
            <div class="row">
            <div class="col-10">

            <h3 class="card-title">{{ $post->title }}</h3>
            </div>
                <div class="col-2">
                    @auth
                        @if($post->user->id == Auth::user()->id)
                            <button type="button" class="btn text-muted"  data-toggle="modal" id="delete-button-{{$post->id}}"><i class="far fa-trash-alt"></i></button>
                            <div class="d-none" id="delete-form">
                                @if($post->user->id == Auth::user()->id)
                                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </div>
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
                        <button type="button" class="btn" data-toggle="collapse" data-target="#comment-{{$post->id}}"><i class="far fa-comment"></i></button>
                    </div>
                    <div class="col text-center">
                        <button class="btn"><i class="far fa-heart"></i></button>
                    </div>
                    <div class="col text-center">
                        <button class="btn"><i class="far fa-bookmark"></i></button>
                    </div>
                </div>
            </div>
            <div class="collapse" id="comment-{{$post->id}}">
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
            </div>
            @auth
            <form method="post" action="" id="comment-form-{{$post->id}}">
                @csrf
                <div class="form-row">
                    <div class="col-8 col-sm-10">
                        <textarea name="content" id="content" rows="2" class="form-control" placeholder="Add a comment..."></textarea>
                    </div>
                    <div class="col-4 col-sm-2">
                        <button class="btn btn-block h-100 btn-outline-success" type="submit">Send</button>
                    </div>
                    <input type="hidden" name="id" value="{{$post->id}}">
                </div>
            </form>
            @endauth
        </div>
    </div>



