@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mb-4">
      <div class="card">
        <div class="card-header">Home</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          Welcome to Loggregate!
        </div>
      </div>
    </div>
    <div class="col-md-8 mb-4">
      <div class="card">
        <div class="card-header">My Classes</div>
        <div class="card-body">
        <?php
        foreach ($myCourses as $class){
          echo '<li class="list-group-item"><a href="/coursehome/'.$class->courseID.'">'. $class->subject . ' ' . $class->courseNum . ' : ' . $class->name .'</a></li>';
        }
        ?>
        </div>
      </div>
    </div>
    <div class="col-md-8 mb-4">
      <div class="card">

        <div class="card-header">My Groups</div>
        <div class="card-body">
        <?php
        foreach ($studyGroups as $group){
          echo '<li class="list-group-item"><a href="/grouphome/'.$group->groupID.'">'. $group->groupName.'</a></li>';
        }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
