<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>IssueCycle</title>

	<?php
	include 'libraries/general.php';
	include 'libraries/css.php'; 
	include 'libraries/issue_list.php'; 
	?>
</head>

<body>

	<?php include 'libraries/header.php'; ?>
	<div class="pushdown70px"></div>

	<main role="main" class="container-fluid">
		<div class="row">
			<div class="col-6">
				<h3 class='font-weight-normal'><i class="fal fa-thumbtack"></i> Pinned Issues</h3>
				<hr>
				<?php
				$sql = "SELECT * FROM `issues` WHERE `issue_pinned`='YES' ORDER BY `id` DESC";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					echo "<div class='list-group'>";
					while($row = $result->fetch_assoc()) {
						$id = $row["id"];
						$issue_subject = $row["issue_subject"];
						$issue_status = $row["issue_status"];
						$issue_project_key = get_issue_project_key_from_issue_id($row['id']);
						$issue_open_since = humanTiming(get_issue_open_timestamp($row['id']));
						if(get_issue_status($id) == "Done") {
							echo "<a href='issue.php?id=$id' class='list-group-item list-group-item-action flex-column align-items-start issue-done'>";
						} else {
							echo "<a href='issue.php?id=$id' class='list-group-item list-group-item-action flex-column align-items-start'>";
						}
						echo "<div class='d-flex w-100 justify-content-between'>";
						echo "<h5 class='font-weight-normal'>";
						if(get_issue_status($id) == "Done") {
							echo "<span class='badge badge-success'>Done</span> [$issue_project_key-$id] $issue_subject";
						} else if(get_issue_status($id) == "In Progress") {
							echo "<span class='badge badge-info'>In Progress</span> [$issue_project_key-$id] $issue_subject";
						} else if(get_issue_status($id) == "On Hold") {
							echo "<span class='badge badge-dark'>On Hold</span> [$issue_project_key-$id] $issue_subject";
						} else {
							echo "<span class='badge badge-primary'>Open</span> [$issue_project_key-$id] $issue_subject";
						}
						echo "</h5>";
						echo "<small>$issue_open_since ago</small>";
						echo "</div>";
						if(empty(get_issue_members($row['id']))) {
							echo "<small>Assignee(s): None";
							echo " | <i class='fal fa-comments'></i> ". get_issue_comment_count($row['id'])." Comments";
							echo "</small>";
						} else {
							$member_count = sizeof(get_issue_members($row['id'])); 
							echo "<small>Assignee(s): ";
							for($i=0; $i<=$member_count; $i++) {
								if($i <= ($member_count-2) && !empty(get_issue_members($row['id'])[$i])) {
									echo get_issue_members($row['id'])[$i].", ";
								} else {
									echo get_issue_members($row['id'])[$i];
								}
							}
							echo " | <i class='fal fa-comments'></i> ". get_issue_comment_count($row['id'])." Comments";
							echo "</small>";
						}
						echo "</a>";
					}
					echo "</div>";
				} else {
					echo "No Pinned Issues.";
				}
				?>
				<hr>
				<h3 class="font-weight-normal"><i class="fal fa-luchador"></i> Assigned to me</h3>
				<hr>
				<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="1-tab" data-toggle="tab" href="#open-in-progress" role="tab" aria-selected="true"><i class="fal fa-box-open"></i> Open/In-Progress</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="2-tab" data-toggle="tab" href="#done" role="tab" aria-selected="false"><i class="fal fa-box-check"></i> Done</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="open-in-progress" role="tabpanel" aria-labelledby="home-tab">
						<?php echo assigned_issue_list("10", $_SESSION['user_id'], "Open", "In Progress"); ?>
					</div>
					<div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="profile-tab">
						<?php echo assigned_issue_list("10", $_SESSION['user_id'], "Done"); ?>
					</div>
				</div>
			</div>
			<div class="col-6">
				<h3 class='font-weight-normal'><i class="fal fa-glasses"></i> Awaiting Review</h3>
				<hr>
				<?php echo general_issue_list("10", "Awaiting Review"); ?>
				<hr>
				<h3 class="font-weight-normal"><i class="fal fa-shipping-fast"></i> Latest issues</h3>
				<hr>
				<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#latest-open-in-progress" role="tab" aria-selected="true"><i class="fal fa-box-open"></i> Open/In-Progress</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#latest-done" role="tab" aria-selected="false"><i class="fal fa-box-check"></i> Done</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="latest-open-in-progress" role="tabpanel" aria-labelledby="home-tab">
						<?php echo general_issue_list("10", "Open", "In Progress"); ?>
					</div>
					<div class="tab-pane fade" id="latest-done" role="tabpanel" aria-labelledby="profile-tab">
						<?php echo general_issue_list("10", "Done"); ?>
					</div>
				</div>
			</div>
		</div>
	</main><!-- /.container -->

	<?php include 'libraries/js.php'; ?>
</body>
</html>