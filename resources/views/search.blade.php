@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Find a Course</div>
                <div class="card-body">

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Select Course Department <span class="caret"></span>
                        </a>

                        <?php
                        foreach ($courses as $course) {
                            echo "<div class='dropdown-menu dropdown-menu-left' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='#'>" . $course->subject . "</a></div>";
                        }
                        ?>
                    </li>

                </div>



            </div>
        </div>
    </div>
</div>
@endsection
