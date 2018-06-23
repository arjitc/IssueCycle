<?php
include 'config/db.php';
include 'libraries/general.php';
$issue_id = mysqli_real_escape_string($conn, $_GET['issue_id']);
$issue_comment = get_issue_comment_from_coment_id($_GET['id']);
$issue_comment_id = $_GET['id'];
$issue_comment_by = $_SESSION['user_id'];
$time = time();
$issue_project_id = get_issue_project_id($issue_id);
$issue_subject_time = date('m/d/Y h:i:s a', time());
$issue_status = "Open";
$issue_etc = "";

$issue_subject = mysqli_real_escape_string($conn, (get_issue_subject($issue_id)." FORK $issue_subject_time"));

$sql = "INSERT INTO `issues` (`id`, `issue_subject`, `issue_body`, `issue_submitter`, `issue_project_id`, `issue_status`, `notifcation_room`,`issue_etc`, `issue_open_timestamp`) VALUES (NULL, '$issue_subject', '$issue_comment', '$user_id', '$issue_project_id', '$issue_status', '',  '$issue_etc', '$time');";

if ($conn->query($sql) === TRUE) {
	$issue_id = $conn->insert_id;
	$sql = "UPDATE `issue_comments` SET `issue_fork_id` = '$issue_id' WHERE `id` = '$issue_comment_id'";
	$conn->query($sql);
	
	header("Location: issue.php?id=$issue_id");

} else {
	header("Location: issue.php?id=$issue_id");
}


