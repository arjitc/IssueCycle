<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'libraries/general.php';
$issue_id = mysqli_real_escape_string($conn, $_POST['issue_id']);
$target_dir = "../attachments/";
$display_name = basename($_FILES["fileToUpload"]["name"]);
$file_name = generateRandomString()."-".basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $file_name;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		//echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$sql = "INSERT INTO `file_attachments` (`id`, `issue_id`, `file_name`, `display_name`) VALUES (NULL, '$issue_id', '$file_name', '$display_name');";
		$conn->query($sql);
		header("Location: issue.php?id=$issue_id");
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	?>