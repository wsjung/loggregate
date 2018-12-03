@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- <div class="row"> -->
            @if ($message = Session::get('success'))

            <div href="/home" class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <!-- </div> -->
        <div class="row justify-content-center">

            <div class="profile-header-container">
                <div class="profile-header-img">
                    <img width="200px" height="200px" class="rounded-circle" src="/storage/avatars/{{ $user->avatar }}">
                    <div align="center" class="rank-label-container">
                        <br>
                        <span class="label label-default rank-label"><h4>{{$user->name}}</h4></span>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="row justify-content-center">
            <form action="/settings" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="avatar"><h4>Change profile picture</h4></label>
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
