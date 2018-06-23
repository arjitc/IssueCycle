<?php
include 'config/db.php';
include 'libraries/general.php';
include 'libraries/mattermost.php';
$issue_id = mysqli_real_escape_string($conn, $_POST['issue_id']);
$issue_comment = mysqli_real_escape_string($conn, $_POST['issue_comment']);
$issue_comment_by = $_SESSION['user_id'];
$issue_comment_on = time();

$sql = "INSERT INTO `issue_comments` (`id`, `issue_id`, `issue_comment_by`, `issue_comment`, `issue_fork_id`, `issue_comment_on`) 
VALUES (NULL, '$issue_id', '$issue_comment_by', '$issue_comment', '', '$issue_comment_on')";
if ($conn->query($sql) === TRUE) {
	header("Location: issue.php?id=$issue_id");
} else {
	header("Location: issue.php?id=$issue_id");
}