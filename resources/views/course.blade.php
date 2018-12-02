@extends('layouts.app')

@section('content')
<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Courses</div>

                <div class="card-body">
                    <?php
                    foreach ($courses as $course) {
                        echo "<p>" . $course->subject . ' ' . $course->courseNum . ' : ' . $course->name . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<main role="main" class="container">
    <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Course List</h1>
  </div>
</div>


<div class=container>

    <div id="accordion">

        <?php
        $temp = "";
        $num = 0;

        foreach($courses as $course) {
            if($course->subject != $temp) {
                if($num > 0) {
                    echo '</ul></div></div>';
                }
                echo '<div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">
                <div data-toggle="collapse" data-parent="#accordion" href="#collapse'.$course->subject.'" class="card-header">
                '.$course->subject.'
                </h4>
                </div>';

                echo '<div id="collapse'.$course->subject.'" class="panel-collapse collapse in">
                <ul class="list-group">';
                $temp = $course->subject;
                $num += 1;
            }

            echo '<li class="list-group-item">'. $course->subject . ' ' . $course->courseNum . ' : ' . $course->name .'</li>';

        }
        ?>
    </div>
</div>
</main>
@endsection
