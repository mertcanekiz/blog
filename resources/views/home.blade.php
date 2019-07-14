@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @foreach ($posts as $post)
                @component('components.post', ['post' => $post])
                @endcomponent
            @endforeach
        </div>
    </div>
</div>
@endsection
