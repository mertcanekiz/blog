@extends('layouts.app')

@section('content')
    <div class="container px-0 px-sm-3" style="max-width: 975px">
        <div class="row mx-sm-5">
            <div class="col-sm-auto px-0"><img src="{{ $user->profile->avatar }}" alt="avatar"
                                          class="rounded-circle d-flex mx-auto w-100" style="max-width:200px"></div>
            <div class="col-sm-1"></div>
            <div class="col-sm-auto pt-3 text-center text-sm-left">
                <div><h1>{{ $user->username }}</h1></div>
                <div><strong>{{ $user->name }}</strong></div>
                <div><p>{{ $user->profile->bio }}</p></div>
                <div>
                @auth
                    @if($user->username == Auth::user()->username)
                    <a href="{{ route('editProfile') }}" class="btn btn-outline-primary">Edit profile</a>
                    @endif
                @endauth
                </div>
            </div>
        </div>
        @auth
{{--            Logged in--}}
        @else
{{--            Not logged in--}}
        @endauth
        <div class="row mt-4">
            <div class="col">
                @foreach ($posts as $post)
                    @component('components.post', ['post' => $post])
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
@endsection
