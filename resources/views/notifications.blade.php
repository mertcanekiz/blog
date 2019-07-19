@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 px-0 px-sm-3">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @foreach (Auth::user()->notifications as $notification)
                @component('components.notification', ['notification' => $notification])
                @endcomponent
            @endforeach
        </div>
    </div>
</div>
@endsection
