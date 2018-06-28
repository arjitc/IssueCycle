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
		<div class="row">
			<div class="col-8">
				<div class="card <?php if(get_issue_status($_GET['id']) == "Done") echo "issue-done"; ?>">
					<div class="card-body">
						<h5 class="card-title">
							<?php
							if(get_issue_status($_GET['id']) == "Done") {
								echo "<span class='badge badge-success'>Done</span>";
							} else if(get_issue_status($_GET['id']) == "In Progress") {
								echo "<span class='badge badge-info'>In Progress</span>";
							} else if(get_issue_status($_GET['id']) == "On Hold") {
								echo "<span class='badge badge-dark'>On Hold</span>";
							} else {
								echo "<span class='badge badge-primary'>Open</span>";
							}
							?>
							[<?php echo get_issue_project_key_from_issue_id($_GET['id'])."-".$_GET['id']; ?>] <?php echo get_issue_subject($_GET['id']); ?>
						</h5>
						<hr>
						<?php echo get_issue_body($_GET['id']); ?>
					</div>
				</div>
				<br>
				<?php if(get_issue_link_count($_GET['id']) >= "1") { ?>
					<div class="card">
						<div class="card-body">
							Linked issue(s) <br>
							<div class='float-left'>
								<?php
								include 'config/db.php';
								$issue_id = mysqli_real_escape_string($conn, $_GET['id']);
								$sql = "SELECT * FROM `issue_links` WHERE `parent_issue_id`='$issue_id'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$linked_issue_id = $row["issue_id"];
										$linked_issue_subject = get_issue_subject($row["issue_id"]);
										$linked_issue_project_id = get_issue_project_key_from_issue_id($row["issue_id"]);
										echo "<a href='issue.php?id=$linked_issue_id'>";
										if(get_issue_status($linked_issue_id) == "Done") {
											echo "<span class='badge badge-success'>Done</span>";
										} else if(get_issue_status($linked_issue_id) == "In Progress") {
											echo "<span class='badge badge-info'>In Progress</span>";
										} else if(get_issue_status($linked_issue_id) == "On Hold") {
											echo "<span class='badge badge-dark'>On Hold</span>";
										} else {
											echo "<span class='badge badge-primary'>Open</span>";
										}
										echo " [$linked_issue_project_id-$linked_issue_id] $linked_issue_subject</a> <small>[Remove Link]</small>";
										echo "<br>";
									}
								}
								?>
							</div>
						</div>
					</div>
					<br>
				<?php } ?>
				<?php if(get_attachment_count($_GET['id']) >= "1") { ?>
					<div class="card">
						<div class="card-body">
							File Attachment(s) <br>
							<div class='float-left'>
								<?php
								include 'config/db.php';
								$issue_id = mysqli_real_escape_string($conn, $_GET['id']);
								$sql = "SELECT * FROM `file_attachments` WHERE `issue_id`='$issue_id'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$file_name = $row["file_name"];
										$display_name = $row['display_name'];
										echo "<a href='download_attachment.php?file_name=$file_name'>$display_name</a> <small>[Remove]</small>";
										echo "<br>";
									}
								}
								?>
							</div>
						</div>
					</div>
					<br>
				<?php } ?>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="home" aria-selected="true">Comment(s)</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#reply" role="tab" aria-controls="profile" aria-selected="false">Reply</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#modify" role="tab" aria-controls="profile" aria-selected="false">Modify</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#log" role="tab" aria-controls="profile" aria-selected="false">Log</a>
					</li>
					<?php 
					if(get_user_name_from_user_id(get_issue_submitter($_GET['id'])) == $_SESSION['user_name']) {
						echo "<li class=nav-item'>";
						echo "<a class='nav-link' data-toggle='tab' href='#delete' role='tab' aria-controls='profile' aria-selected='false'>Delete Issue</a>";
						echo "</li>";
					}
					?>
				</ul>
				<br>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="comments" role="tabpanel" aria-labelledby="home-tab">
						<?php
						include 'config/db.php';
						$issue_id = mysqli_real_escape_string($conn, $_GET['id']);
						$sql = "SELECT * FROM `issue_comments` WHERE `issue_id`='$issue_id' ORDER BY `id` DESC";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$issue_comment_id = $row["id"];
								$issue_comment_by = get_user_name_from_user_id($row["issue_comment_by"]);
								$issue_comment_on = date('d/m/Y H:i:s', $row["issue_comment_on"]);
								$issue_fork_id = $row['issue_fork_id'];
								echo "<div class='card'>";
								echo "<div class='card-header text-muted'>";
								echo "<span class='align-middle'>$issue_comment_by on $issue_comment_on</span>";
								echo "<div class='float-right'>";
								echo "<span class='align-middle'><div class='dropdown'>
								<button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								<i class='fas fa-ellipsis-v'></i>
								</button>
								<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
								<a class='dropdown-item' href='reply_comment.php?id=$issue_comment_id&issue_id=$issue_id'><i class='fas fa-reply'></i> Reply</a>";
								if(!empty($issue_fork_id)) {
									echo "<a class='dropdown-item' href='issue.php?id=$issue_fork_id'>View Forked Issue</a>";									
								} else {
									echo "<a class='dropdown-item confirmation' href='fork_issue.php?id=$issue_comment_id&issue_id=$issue_id'><i class='fas fa-code-branch'></i> Fork Issue</a>";
								}
								if($_SESSION['user_id'] == $row["issue_comment_by"]) {
									echo "<a class='dropdown-item confirmation' href='delete_issue_comment.php?id=$issue_comment_id&issue_id=$issue_id'><i class='fas fa-trash'></i> Delete</a>";
								}
								echo "</div>
								</div></span>";
								echo "</div>";
								echo "</div>";
								echo "<div class='card-body'>";
								echo $row['issue_comment'];
								echo "</div>";
								echo "</div>";
								echo "<hr>";
							}
						} else {
							echo "No Comment(s) Found!";
							echo "<div style='padding-bottom: 200px;'></div>";
						}
						$conn->close();
						?>

					</div>
					<div class="tab-pane fade" id="reply" role="tabpanel" aria-labelledby="profile-tab">
						<form action="issue_comment_db.php" method="post">
							<input type="hidden" name="issue_id" value="<?php echo $_GET['id']; ?>">
							<textarea id="summernote" name="issue_comment"></textarea><hr>
							<center><input type="submit" class="btn btn-primary"></center>
						</form>
					</div>
					<div class="tab-pane fade show" id="modify" role="tabpanel" aria-labelledby="home-tab">
						<div class="card text-center">
							<div class="card-header">
								<ul class="nav nav-tabs card-header-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#assignees" role="tab" aria-controls="profile" aria-selected="false">Assignees</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="home-tab" data-toggle="tab" href="#issue_status" role="tab" aria-controls="home" aria-selected="true">Issue Status</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="home-tab" data-toggle="tab" href="#issue_project" role="tab" aria-controls="home" aria-selected="true">Issue Project</a>
									</li>
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content">
									<div class="tab-pane fade show active" id="assignees" role="tabpanel" aria-labelledby="profile-tab">
										<form action="modify_issue.php" method="post" id="issue_assignees_form">
											<input type="hidden" name="issue_id" value="<?php echo $_GET['id']; ?>">
											<?php
											include 'config/db.php';
											$sql = "SELECT * FROM `users`";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												echo "<select class='form-control' name='issue_assignee' form='issue_assignees_form'>";
												while($row = $result->fetch_assoc()) {
													$id = $row["user_id"];
													$user_name = $row["user_name"];
													echo "<option value='$id'>$user_name</option>";
												}
												echo "</select>";
											} else {
												echo "0 results";
											}
											?>
											<br>
											<center><button type="submit" class="btn btn-primary mb-2">Add</button></center>
										</form>
									</div>
									<div class="tab-pane fade" id="issue_status" role="tabpanel" aria-labelledby="home-tab">
										<form action="modify_issue.php" method="post" id="issue_status_form">
											<input type="hidden" name="issue_id" value="<?php echo $_GET['id']; ?>">
											<?php
											echo "<select class='form-control' name='issue_status' form='issue_status_form'>";
											echo "<option value='Open'>Open</option>
											<option value='In Progress'>In Progress</option>
											<option value='On Hold'>On Hold</option>
											<option value='Awaiting Review'>Awaiting Review</option>
											<option value='Done'>Done</option>";
											echo "</select>";
											?>
											<br>
											<center><button type="submit" class="btn btn-primary mb-2">Change</button></center>
										</form>
									</div>
									<div class="tab-pane fade" id="issue_project" role="tabpanel" aria-labelledby="home-tab">
										<form action="modify_issue.php" method="post" id="issue_project_form">
											<input type="hidden" name="issue_id" value="<?php echo $_GET['id']; ?>">
											<?php
											include 'config/db.php';
											$sql = "SELECT * FROM `projects`";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												echo "<select class='form-control' name='issue_project_id' form='issue_project_form'>";
												while($row = $result->fetch_assoc()) {
													$id = $row["id"];
													$project_name = $row["project_name"];
													echo "<option value='$id'>$project_name</option>";
												}
												echo "</select>";
											} else {
												echo "0 results";
											}
											?>
											<br>
											<center><button type="submit" class="btn btn-primary mb-2">Update</button></center>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade show" id="log" role="tabpanel" aria-labelledby="home-tab">...</div>
					<div class="tab-pane fade show" id="delete" role="tabpanel" aria-labelledby="home-tab">
						<div class="alert alert-warning" role="alert">
							<b>Warning</b> If you delete this issue, all comments, information is lost!
						</div>
						<form action="delete_issue.php" method="post">
							<input type="hidden" name="issue_id" value="<?php echo $_GET['id']; ?>">
							<center><input class="btn btn-danger confirmation" type="submit" value="Delete Issue"></center>
						</form>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						Assignee(s) 
						<div class="pull-right">
							<?php 
							$member_count = sizeof(get_issue_members($_GET['id'])); 
							if($member_count > "0") {
								for($i=0; $i<=$member_count; $i++) {
									if($i <= ($member_count-2) && !empty(get_issue_members($_GET['id'])[$i])) {
										echo get_issue_members($_GET['id'])[$i].", ";
									} else {
										echo get_issue_members($_GET['id'])[$i];
									}
								}
							} else {
								echo "None";
							}
							?>
						</div>
						<hr>
						Submitted On 
						<div class="pull-right"><?php echo date('d/m/Y H:i:s', get_issue_open_timestamp($_GET['id'])); ?></div>
						<hr>
						Time Elapsed
						<div class="pull-right"><?php echo humanTiming(get_issue_open_timestamp($_GET['id'])); ?></div>
						<hr>
						Submitted By
						<div class="pull-right"><?php echo get_user_name_from_user_id(get_issue_submitter($_GET['id'])); ?></div>
						<hr>
						Status
						<div class="pull-right"><?php echo get_issue_status($_GET['id']); ?></div>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-body">
						<center>
							<a class="card-link" href="edit_issue.php?id=<?php echo $_GET['id']; ?>"><i class="fal fa-file-edit"></i> Edit</a>
							<a class="card-link" href="modify_issue.php?issue_id=<?php echo $_GET['id']; ?>&pin_issue=YES"><i class="fas fa-star"></i> Pin Issue</a>
							<a class="card-link" href="modify_issue.php?issue_id=<?php echo $_GET['id']; ?>&pin_issue=NO"><i class="fal fa-star"></i> Un-Pin Issue</a>
						</center>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-body">
						Link issue(s)
						<form>
							<select class="form-control" name="users" onchange="showIssue(this.value, <?php echo $_GET['id']; ?>)">
								<option value="">Select a project</option>
								<?php
								$sql = "SELECT * FROM `projects`";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$id = $row["id"];
										$project_name = $row["project_name"];
										echo "<option value='$id'>$project_name</option>";
									}
								} else {
									echo "No Project(s) found.";
								}
								?>
							</select>
						</form>
						<div id="txtHint"></div>
					</div>
				</div>
				<hr>
				<div class="card">
					<div class="card-body">
						Attach file(s)
						<form action="attach_file.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="issue_id" value="<?php echo $_GET['id']; ?>">
							<input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
							<input type="submit" class="btn btn-primary btn-block" value="Attach" name="submit">
						</form>
					</div>
				</div>
			</div>
		</div>
	</main><!-- /.container -->

	<?php include 'libraries/js.php'; ?>
</body>
</html>