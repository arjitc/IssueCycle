<?php
function debug() {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}
function get_issue_subject($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_subject FROM `issues` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_subject"];
		}
	} else {
		return 0;
	}
}
function get_issue_body($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_body FROM `issues` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_body"];
		}
	} else {
		return 0;
	}
}
function get_issue_project_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_project_id FROM `issues` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_project_id"];
		}
	} else {
		return 0;
	}
}
function get_issue_project_key_from_issue_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$project_id = get_issue_project_id($id);
	$sql = "SELECT project_key FROM `projects` WHERE `id`='$project_id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["project_key"];
		}
	} else {
		return 0;
	}
}
function get_issue_open_timestamp($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_open_timestamp FROM `issues` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_open_timestamp"];
		}
	} else {
		return 0;
	}
}
function get_user_name_from_user_id($user_id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$user_id  = mysqli_real_escape_string($conn, $user_id);
	$sql = "SELECT user_name FROM `users` WHERE `user_id`='$user_id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["user_name"];
		}
	} else {
		return 0;
	}
}
function get_issue_submitter($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_submitter FROM `issues` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_submitter"];
		}
	} else {
		return 0;
	}
}
function get_issue_status($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_status FROM `issues` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_status"];
		}
	} else {
		return 0;
	}
}
function get_issue_comment_from_comment_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_comment FROM `issue_comments` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_comment"];
		}
	} else {
		return 0;
	}
}
function get_issue_comment_by_from_comment_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_comment_by FROM `issue_comments` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_comment_by"];
		}
	} else {
		return 0;
	}
}
function get_issue_comment_on_from_comment_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_comment_on FROM `issue_comments` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["issue_comment_on"];
		}
	} else {
		return 0;
	}
}
function humanTiming($timeline) {
	$timeline = time()-$timeline;
	$periods = array('day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);

	foreach($periods AS $name => $seconds){
		$num = floor($timeline / $seconds);
		$timeline -= ($num * $seconds);
		$ret .= $num.' '.$name.(($num > 1) ? 's' : '').' ';
	}
	return trim($ret);
}
function get_project_key_from_project_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT project_key FROM `projects` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["project_key"];
		}
	} else {
		return 0;
	}
}
function get_project_name_from_project_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT project_name FROM `projects` WHERE `id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["project_name"];
		}
	} else {
		return 0;
	}
}
function get_issue_members($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT issue_member_id FROM `issue_members` WHERE `issue_id`='$id'";
	$result = $conn->query($sql);
	$i = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$issue_members[$i] = get_user_name_from_user_id($row["issue_member_id"]);
			$i++;
		}
		return $issue_members;
	} else {
		return 0;
	}
}
function get_notifcation_room($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$project_id = get_issue_project_id($id);
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT notifcation_room FROM `projects` WHERE `id`='$project_id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["notifcation_room"];
		}
	} else {
		return 0;
	}
}
function get_mattermost_user_name_from_user_id($id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$id  = mysqli_real_escape_string($conn, $id);
	$sql = "SELECT mattermost_username FROM `users` WHERE `user_id`='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["mattermost_username"];
		}
	} else {
		return 0;
	}
}
function get_current_week() {
	$monday = strtotime("last monday");
	$day['0'] = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
	for($i=1; $i<=6; $i++) {
		$day[$i] = strtotime(date("Y-m-d", $day['0'])." +$i days");
	}
	return $day;
}
function get_issue_link_count($issue_id) {
	include 'config/db.php';
	$issue_id = mysqli_real_escape_string($conn, $issue_id);
	$sql = "SELECT * FROM `issue_links` WHERE `parent_issue_id`='$issue_id'";
	$result = $conn->query($sql);
	return $result->num_rows;
}
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function get_attachment_count($issue_id) {
	include 'config/db.php';
	$issue_id = mysqli_real_escape_string($conn, $issue_id);
	$sql = "SELECT * FROM `file_attachments` WHERE `issue_id`='$issue_id'";
	$result = $conn->query($sql);
	return $result->num_rows;
}
function get_issue_comment_count($issue_id) {
	include 'config/db.php';
	$issue_id = mysqli_real_escape_string($conn, $issue_id);
	$sql = "SELECT * FROM `issue_comments` WHERE `issue_id`='$issue_id'";
	$result = $conn->query($sql);
	return $result->num_rows;
}