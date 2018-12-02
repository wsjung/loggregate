@extends('layouts.app')

@section('content')


<main role="main" class="container">
    <?php 
    if(isset($subbed)) {
        echo '<div href="/home" class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Crispy guacamole!</strong> You subscribed to your courses. View them in the home page!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    ?>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Find a course</h1>
        <br>
        <h5>To add classes click the class you want to enroll in </h5>
        <h5>To delete classes click class you want to remove in your list </h5>
        <h5>Once you have slected all the courses you want to enroll in, hit enroll</h5>
    </div>
</div>


<div class="container" id="selectedCourses">
    <form id="selectForm" action="{{ route('subList') }}" method="GET">
        <h5>Your classes: <input type="submit" value="Subscribe"></h5>
    </form>
</div>

<br>

<div class="container">
    <br>
    <h5>Course list:</h5>
</div>

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

            echo '<li class="list-group-item" id="item' . $course->subject . $course->courseNum . '" onclick="addCourse(\'' . $course->subject . '\',\'' . $course->courseNum . '\',\'' . $course->courseID . '\')">'. $course->subject . ' ' . $course->courseNum . ' : ' . $course->name  . '</li>';

        }
        ?>
    </div>
</div>
</main>

<script type="text/javascript">
    var i = 0;
    // functions for adding selected element to top
    function addCourse(subject, courseNum, courseID) {
        // adds selected course to top
        var l = document.getElementById('item' + subject + courseNum);
        if(l.style.backgroundColor === "rgb(255, 255, 255)" || l.style.backgroundColor === "") {
            var p = document.getElementById('selectForm');
            var newCourse = document.createElement('input');
            newCourse.setAttribute('type','text');
            newCourse.setAttribute('name','' + i);
            newCourse.setAttribute('class', 'btn btn-outline-primary');
            newCourse.setAttribute('id', 'selected'+subject+courseNum);
            newCourse.setAttribute('onclick', 'removeCourse(this.id);');
            newCourse.setAttribute('value', '' + subject + ' : ' + courseNum);
            // newCourse.setAttribute('placeholder','' + subject + ' : ' + courseNum);
            newCourse.innerHTML = subject + ' : ' + courseNum;
            p.appendChild(newCourse);
            i = i+1;

            // recolors selected course in list
            l.style.backgroundColor = '#3399ff';
            return;
        } 
        if(l.style.backgroundColor === "rgb(51, 153, 255)") {
            removeCourse('selected'+subject+courseNum);
            l.style.backgroundColor = '#fff';
        }
    }

    // function for removing select element from top
    function removeCourse(elementID) {
        // element to remove
        var element = document.getElementById(elementID);
        // index of element to remove
        var index = element.name; // i
        var id = element.id.slice(8);
        // parent
        var parent = element.parentNode;
        var children = parent.children;
        var x;
        // decrement rest higher than index
        for(x=0;x<children.length;x++) {
            if(children[x].name > index) {
                children[x].name = '' + (parseInt(children[x].name) - 1);
            }
        }

        element.parentNode.removeChild(element);
        var p = document.getElementById('item' + id);
        p.style.backgroundColor = '#fff';
        i = i -1;
    }
</script>
@endsection
