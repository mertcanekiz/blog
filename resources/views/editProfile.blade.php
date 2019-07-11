@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit profile</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('editProfile') }}">
            @csrf
            <div class="form-group">
                <label class="col-form-label" for="bio">Bio</label>
                <textarea class="@error('bio') is-invalid @enderror form-control" id="bio" name="bio"></textarea>
            </div>
            <div class="form-group">
                <label for="avatar" class="@error('avatar') is-invalid @enderror col-form-label">Profile picture</label>
                <input class="form-control" type="url" id="avatar" name="avatar" placeholder="Enter URL">
            </div>
            <button class="btn btn-outline-success" type="submit">Save</button>
            <a href="{{ route('profile') }}" class="btn btn-outline-danger">Cancel</a>

        </form>
    </div>
@endsection
