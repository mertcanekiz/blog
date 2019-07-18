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
                <div class="card-header">New Post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label" for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-form-label">Content</label>
                            <textarea name="content" id="content" rows="4" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="tags" name="tags" data-role="tagsinput">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
