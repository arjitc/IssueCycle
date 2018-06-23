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

		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update Password</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<form action="update_password.php" method="post">
							<div class="form-group">
								<label for="exampleInputEmail1">New Password</label>
								<input type="password" class="form-control" name="password1" placeholder="New Password" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">New Password (Repeat)</label>
								<input type="password" class="form-control" name="password2" placeholder="New Password (Repeat)" autocomplete="off">
							</div>
							<hr>
							<center><button type="submit" class="btn btn-primary">Submit</button></center>
						</form>
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
				</div>
			</div>
		</div>

	</main><!-- /.container -->

	<?php include 'libraries/js.php'; ?>
</body>
</html>