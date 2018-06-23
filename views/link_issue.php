<?php
include 'config/db.php';
include 'libraries/general.php';

$parent_issue_id = mysqli_real_escape_string($conn, $_GET['parent_issue_id']);
$issue_id = mysqli_real_escape_string($conn, $_GET['issue_id']);

if(isset($parent_issue_id, $issue_id)) {
	$sql = "INSERT INTO `issue_links` (`id`, `parent_issue_id`, `issue_id`) VALUES (NULL, '$parent_issue_id', '$issue_id');";
	$conn->query($sql);

	header("Location: issue.php?id=$parent_issue_id");
	$conn->close();
} else {
	header("Location: index.php");
}
?>
