<?php
include 'config/db.php';
include 'libraries/general.php';

$project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
$project_description = mysqli_real_escape_string($conn, $_POST['project_description']);
$project_notification_room = mysqli_real_escape_string($conn, $_POST['project_notification_room']);
$project_key = strtoupper(substr($project_name, 0, 5));

if(isset($project_name, $project_description, $project_key)) {

	$sql = "INSERT INTO `projects` (`id`, `project_name`, `project_description`, `project_key`, `notifcation_room`) VALUES (NULL, '$project_name', '$project_description', '$project_key', '$project_notification_room');";
	$conn->query($sql);

	$project_id = $conn->insert_id;

	header("Location: project.php?id=$project_id");
	$conn->close();
} else {
	header("Location: index.php");
}
?>
