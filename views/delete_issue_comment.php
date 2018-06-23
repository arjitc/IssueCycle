<?php
include 'config/db.php';
$comment_id = mysqli_real_escape_string($conn, $_GET['id']);
$issue_id = mysqli_real_escape_string($conn, $_GET['issue_id']);

$sql = "DELETE FROM `issue_comments` WHERE `id`='$comment_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: issue.php?id=$issue_id");
} else {
    header("Location: issue.php?id=$issue_id");
}
?>