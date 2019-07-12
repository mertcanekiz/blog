
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $post->author->username }}</h6>
            <p class="card-text">{{ $post->content }}</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>

        {{ $slot }}
    </div>
