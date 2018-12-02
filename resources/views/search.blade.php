@extends('layouts.app')

@section('content')


<main role="main" class="container">



    <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Find a course</h1>
    <br>
    <h5>To add classes click the class you want to enroll in </h5>
    <h5>To delete classes click class you want to remove in your list </h5>
    <h5>Once you have slected all the courses you want to enroll in, hit enroll</h5>
  </div>
</div>


 <h5>Your classes:</h5>

<div class="container" id="selectedCourses">
</div>
<br>

<div class=container>
    <br>
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

            echo '<li class="list-group-item" id="item' . $course->subject . $course->courseNum . '" onclick="addCourse(\'' . $course->subject . '\',\'' . $course->courseNum . '\')">'. $course->subject . ' ' . $course->courseNum . ' : ' . $course->name  . '</li>';

        }
        ?>
    </div>
</div>
</main>

<script type="text/javascript">
    // functions for adding selected element to top
    function addCourse(subject, courseID) {
        // adds selected course to top
        var l = document.getElementById('item' + subject + courseID);
        if(l.style.backgroundColor === "rgb(255, 255, 255)" || l.style.backgroundColor === "") {
            var p = document.getElementById('selectedCourses');
            var newCourse = document.createElement('button');
            newCourse.setAttribute('class', 'btn btn-outline-primary');
            newCourse.setAttribute('id', 'selected'+subject+courseID);
            newCourse.setAttribute('onclick', 'removeCourse(this.id);');
            newCourse.innerHTML = subject + ' : ' + courseID;
            p.appendChild(newCourse);

            // recolors selected course in list
            l.style.backgroundColor = '#3399ff';
            return;
        } 
        if(l.style.backgroundColor === "rgb(51, 153, 255)") {
            removeCourse('selected'+subject+courseID);
            l.style.backgroundColor = '#fff';
        }
    }

    // function for removing select element from top
    function removeCourse(elementID) {
        var element = document.getElementById(elementID);
        var id = element.id.slice(8);
        element.parentNode.removeChild(element);
        var p = document.getElementById('item' + id);
        p.style.backgroundColor = '#fff';
    }
</script>
@endsection
