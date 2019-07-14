
    <div class="card w-100 mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <a href="{{ route('profileWithUsername', ['username' => $post->user->username]) }}"><h6 class="card-subtitle mb-2 text-muted">{{ $post->user->username }}</h6></a>
            <p class="card-text">{{ $post->content }}</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>

        {{ $slot }}
    </div>
