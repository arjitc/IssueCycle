<?php
include 'config/db.php';
include 'libraries/general.php';

$issue_id = mysqli_real_escape_string($conn, $_POST['issue_id']);
$issue_body = mysqli_real_escape_string($conn, $_POST['issue_body']);
$user_id = $_SESSION['user_id'];
if(isset($issue_id, $issue_body)) {
	$sql = "UPDATE `issues` SET `issue_body`='$issue_body' WHERE `id`='$issue_id'";
	$conn->query($sql);

	header("Location: issue.php?id=$issue_id");
	$conn->close();
} else {
	header("Location: index.php");
}
?>
