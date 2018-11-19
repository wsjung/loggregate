@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Find a Course</div>
                <div class="card-body">

                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Select Subject <span class="caret"></span>
                        </a>
                        <div class='dropdown-menu dropdown-menu-left' aria-labelledby='navbarDropdown'>
                            <?php
                            foreach ($courses as $course) {

                                echo "<a class='dropdown-item' href='#'>" . $course->subject . "</a>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Select Subject <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <?php
                                $count = 0;
                                echo "<div class=\"col-sm-4\">
                                    <ul class=\"multi-column-dropdown\">";
                                foreach ($courses as $course) {
                                    if($count > 1 && $count%20==1) {
                                        echo "</ul></div>
                                        <div class=\"col-sm-4\">
                                    <ul class=\"multi-column-dropdown\">";
                                    }
                                    echo "<li><a href=\"#\">" . $course->subject . "</a></li>";
                                    $count+=1;
                                }
                                echo "</ul></div>";
                                ?>
                            </div>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Select Subject <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <?php
                                $count = 0;
                                echo "<div class=\"col-sm-4\">
                                    <ul class=\"multi-column-dropdown\">";
                                foreach ($courses as $course) {
                                    if($count > 1 && $count%15==1) {
                                        echo "</ul></div>
                                        <div class=\"col-sm-4\">
                                    <ul class=\"multi-column-dropdown\">";
                                    }
                                    echo "<li><a id=\"redlink\" href=\"#\">" . $course->subject . "</a></li>";
                                    $count+=1;
                                }
                                echo "</ul></div>";
                                ?>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
