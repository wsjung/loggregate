@extends('layouts.app')

@section('content')
<div class="container">
	<?php 
    if(isset($PHgroupName)) {
        echo '<div href="/home" class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong>  Looks like this study group already exists! <a href="/coursehome/'.$courses[0]->courseID.'"> See study groups</a>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    ?>
	<div class="py-5 text-center">
		<h2>Create New Study Group</h2>
		<h5>for</h5>
		<?php
			echo '<h3>' . $courses[0]->subject . ' ' . $courses[0]->courseNum . ' : ' . $courses[0]->name . '</h3>';
		?>
	</div>

	<div class="row">
		<div class="col-md-9 mx-auto border-left border-right">
			<form action="{{ route('groupcreate',$id) }}" class="needs-validation" novalidate>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="groupName">Group name</label>
						<input type="text" class="form-control" id="groupName" name="groupName" placeholder="" value="<?php if(isset($PHgroupName)) {
							echo '' . $PHgroupName;
						} ?>" required>
						<div class="invalid-feedback">
							Group name is required.
						</div>
					</div>
				</div>

				<div class="mb-3">
					<label for="description">Description</label>
					<textarea type="text" class="form-control" id="description" name="groupDescription" rows="4" placeholder="" 
						value=""><?php if(isset($PHdesc)) {
							echo '' . $PHdesc;
						} ?></textarea>
				</div>
				<div class="row">
					<div class="col-md-3 mb-3">
						<label for="day">Day</label>
						<br>
						<div>
						<label>
							<input type="checkbox" name="Monday" value="M">
							<br>M
						</label>
						<label>
							<input type="checkbox" name="Monday" value="Tu">
							<br>Tu
						</label>
						<label>
							<input type="checkbox" name="Wednesday" value="W">
							<br>W
						</label>
						<label>
							<input type="checkbox" name="Thursday" value="Th">
							<br>Th
						</label>
						<label>
							<input type="checkbox" name="Friday" value="F">
							<br>F
						</label>
						<label>
							<input type="checkbox" name="Saturday" value="Sa">
							<br>Sa
						</label>
						<label>
							<input type="checkbox" name="Sunday" value="Su">
							<br>Su
						</label>
						</div>
						<div class="invalid-feedback">
							Date is required.
						</div>
					</div>

					<div class="col-md-3 mb-3">
						<label for="time">Time</label>
						<input type="time" class="form-control" name="meetTime" id="time" value="<?php if(isset($PHmeetTime)) {
							echo '' . $PHmeetTime;
						} ?>" required>
						<div class="invalid-feedback">
							Time is required.
						</div>
					</div>

					<div class="col-md-6 mb-3">
						<label for="location">Location</label>
						<input type="text" class="form-control" id="location" name="meetLocation" value="<?php if(isset($PHmeetLocation)) {
							echo '' . $PHmeetLocation;
						} ?>" required>
						<div class="invalid-feedback">
							Location is required.
						</div>
					</div>
				</div>
				<br>
				<br>
				<br>
				<button class="btn btn-primary btn-lg btn-block" type="submit">Create!</button>
			</form>
		</div>
	</div>

	<script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
      	'use strict';

      	window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
          	form.addEventListener('submit', function(event) {
          		if (form.checkValidity() === false) {
          			event.preventDefault();
          			event.stopPropagation();
          		}
          		form.classList.add('was-validated');
          	}, false);
          });
      }, false);
      })();
  </script>
  @endsection
