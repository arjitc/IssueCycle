<?php
include 'libraries/general.php';

if(isset($_POST['issue_assignee'])) {
	$user_id = $_POST['issue_assignee'];
	$time = time();
	$issue_id = $_POST['issue_id'];
	$sql = "INSERT INTO `issue_members` (`id`, `issue_id`, `issue_member_id`, `issue_member_added_timestamp`) 
	VALUES (NULL, '$issue_id', '$user_id', '$time');";

	$conn->query($sql);


	header("Location: issue.php?id=$issue_id");
}
if(isset($_POST['issue_status'])) {
	$issue_status = $_POST['issue_status'];
	$issue_id = $_POST['issue_id'];
	$sql = "UPDATE `issues` SET `issue_status` = '$issue_status' WHERE `id` = '$issue_id';";
	$conn->query($sql);

	header("Location: issue.php?id=$issue_id");
}
if(isset($_POST['issue_project_id'])) {
	$issue_project_id = $_POST['issue_project_id'];
	$issue_id = $_POST['issue_id'];
	$sql = "UPDATE `issues` SET `issue_project_id` = '$issue_project_id' WHERE `id` = '$issue_id';";
	$conn->query($sql);

	header("Location: issue.php?id=$issue_id");
}
if(isset($_GET['pin_issue']) && isset($_GET['issue_id'])) {
	$pin_issue = $_GET['pin_issue'];
	$issue_id = $_GET['issue_id'];
	if($pin_issue == "NO") {
		$sql = "UPDATE `issues` SET `issue_pinned` = '' WHERE `id` = '$issue_id';";
	} else {
		$sql = "UPDATE `issues` SET `issue_pinned` = 'YES' WHERE `id` = '$issue_id';";
	}
	$conn->query($sql);

	header("Location: issue.php?id=$issue_id");
}
?>