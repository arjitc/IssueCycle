<?php
include 'config/db.php';
$issue_id = mysqli_real_escape_string($conn, $_POST['issue_id']);

$sql = "DELETE FROM `issue_comments` WHERE `issue_id`='$issue_id'";
$conn->query($sql);
$sql = "DELETE FROM `issues` WHERE `id`='$issue_id'";
$conn->query($sql);
header("Location: index.php");
?>