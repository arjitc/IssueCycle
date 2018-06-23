<?php
include 'config/db.php';
include 'libraries/general.php';
include 'libraries/mattermost.php';
$issue_subject = mysqli_real_escape_string($conn, $_POST['issue_subject']);
$issue_body = mysqli_real_escape_string($conn, $_POST['issue_body']);
$user_id = $_SESSION['user_id'];
$issue_status = mysqli_real_escape_string($conn, $_POST['issue_status']);
$issue_project_id = mysqli_real_escape_string($conn, $_POST['issue_project_id']);
$issue_etc = mysqli_real_escape_string($conn, $_POST['issue_etc']);
$time = time();
if(isset($issue_subject, $issue_body, $issue_status)) {
	$sql = "INSERT INTO `issues` (`id`, `issue_subject`, `issue_body`, `issue_submitter`, `issue_project_id`, `issue_status`, `issue_etc`, `issue_open_timestamp`) VALUES (NULL, '$issue_subject', '$issue_body', '$user_id', '$issue_project_id', '$issue_status', '$issue_etc', '$time');";
	$conn->query($sql);
	$issue_id = $conn->insert_id;

	header("Location: issue.php?id=$issue_id");
	$conn->close();
} else {
	header("Location: index.php");
}
?>
