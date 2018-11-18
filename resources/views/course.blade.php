@extends('layouts.app')

@section('content')
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
@endsection
