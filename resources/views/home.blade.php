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
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                </div>
            </div>
        </div>
        @foreach ($posts as $post)
            @component('post', ['post' => $post])
            @endcomponent
        @endforeach
    </div>
</div>
@endsection
