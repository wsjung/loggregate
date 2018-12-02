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
        <div class="card-body"></div>
        <?php
        foreach ($myCourses as $class){
          echo '<li class="list-group-item">'. $class->subject . ' ' . $class->courseNum . ' : ' . $class->name .'</li>';
        }
        ?>
      </div>
    </div>
    <div class="col-md-8 mb-4">
      <div class="card">

        <div class="card-header">My Groups</div>
        <div class="card-body"></div>
        <?php
        foreach ($studyGroups as $group){
          echo '<li class="list-group-item">'. $group->groupName . ' : ' . $group->meetTime . ' ' . $group->meetDay . ' , '. $group->meetLocation .'</li>';
        }
        ?>
      </div>
    </div>
  </div>
</div>
@endsection
