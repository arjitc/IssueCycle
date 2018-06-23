<?php
include 'config/db.php';
$user_id = $_SESSION['user_id'];
if($_POST['password1'] == $_POST['password2'] && !empty($_POST['password1'])) {
	$password_hash = password_hash($_POST['password1'], PASSWORD_DEFAULT);
	$sql = "UPDATE `users` SET `user_password_hash`='$password_hash' WHERE `user_id`='$user_id'";
	$conn->query($sql);
	echo "Record updated successfully";
}
?>