@extends('layouts.app')

@section('content')
<div class="container">
  <?php 
  if(isset($deletedGroupName)) {
    echo '<div href="/home" class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Study group deleted!</strong> Successfully deleted study group <strong>'.$deletedGroupName.'</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  if(isset($leftGroupName)) {
    echo '<div href="/home" class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Study group deleted!</strong>  No members left. Group <strong>'.$leftGroupName.'</strong> has been deleted.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  ?>
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
          if($myCourses->count() === 0) {
            echo '<div class="col-md-8 mb-3"><span style="float:left;">No courses!</span><center><span style="float:right;"><form action="/search"><button class="btn btn-info">Subscribe to courses</button></form></span></center></div>';
          }
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
          if($studyGroups->count() === 0) {
            echo '<div class="col-md-8 mb-3"><span style="float:left;">No study groups! <br> Click on a Course to create new study group or subscribe to existing ones!</span><center><span style="float:right;"><form action="/search"></form></span></center></div>';
          }
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
