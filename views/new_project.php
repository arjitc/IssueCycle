<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>IssueCycle</title>

	<?php
	include 'libraries/general.php';
	include 'libraries/css.php'; 
	?>
</head>

<body>

	<?php include 'libraries/header.php'; ?>
	<div class="pushdown70px"></div>

	<main role="main" class="container-fluid">
		<h2> New Project </h2>
		<hr>
		<form action="new_project_db.php" method="post">
			<div class="form-group">
				<label for="exampleInputEmail1">Project Name</label>
				<input type="text" class="form-control" name="project_name" placeholder="Project Name" required>
				<small class="form-text text-muted">What this project would be called</small>
			</div>
			<div class="form-group">
				<label>Project Description</label>
				<input type="text" class="form-control" name="project_description" placeholder="Project Description" required>
				<small class="form-text text-muted">A small description about this project</small>
			</div>
			<div class="form-group">
				<label>Project Notification Room</label>
				<input type="text" class="form-control" name="project_notification_room" placeholder="Project Notification Room">
				<small class="form-text text-muted">Leave empty for default.</small>
			</div>
			<hr>
			<center><button type="submit" class="btn btn-primary">Submit</button></center>
		</form>

	</main><!-- /.container -->

	<?php include 'libraries/js.php'; ?>
</body>
</html>