<?php
include '/var/www/html/config/db.php';
include 'general.php';
$id = mysqli_real_escape_string($conn, $_GET['id']);
$issue_id = $_GET['issue_id'];
$sql = "SELECT * FROM `issues` WHERE `issue_project_id`='$id' ORDER BY `id` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<hr>";
	while($row = $result->fetch_assoc()) {
		$id = $row["id"];
		$issue_subject = $row["issue_subject"];
		echo "<a href='link_issue.php?issue_id=$id&parent_issue_id=$issue_id' class='list-group-item list-group-item-action flex-column align-items-start'>";
		echo "<div class='d-flex w-100 justify-content-between'>";
		echo "<h5 class='font-weight-normal'>";
		echo "#$id - $issue_subject";
		echo "</h5>";
		echo "</div>";
		echo "</a>";
	}
} else {
	echo "No issue(s) found.";
}
?>