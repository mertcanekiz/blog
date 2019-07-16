@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">



        <a href="{{route("imageposts.create")}}"  class="btn btn-default">
Submit
        </a>
        <a href="{{route("posts.create")}}"  class="btn btn-default">
            Submit

        </a>


    </div>
</div>
    @endsection