<?php
function general_issue_list($limit, $issue_status, $issue_status2=NULL) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	include_once realpath(dirname(__FILE__)).'../libraries/general.php';
	if($issue_status2 != NULL && $assignee = NULL) {
		$sql = "SELECT * FROM `issues` WHERE `issue_status`='$issue_status' OR `issue_status`='$issue_status2' ORDER BY `id` DESC LIMIT $limit";
	} else {
		$sql = "SELECT * FROM `issues` WHERE `issue_status`='$issue_status' ORDER BY `id` DESC LIMIT $limit";
	}
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<div class='list-group'>";
		while($row = $result->fetch_assoc()) {
			$id = $row["id"];
			$issue_subject = $row["issue_subject"];
			$issue_status = $row["issue_status"];
			$issue_project_key = get_issue_project_key_from_issue_id($row['id']);
			$issue_open_since = humanTiming(get_issue_open_timestamp($row['id']));
			if(get_issue_status($id) == "Done") {
				echo "<a href='issue.php?id=$id' class='list-group-item list-group-item-action flex-column align-items-start issue-done'>";
			} else {
				echo "<a href='issue.php?id=$id' class='list-group-item list-group-item-action flex-column align-items-start'>";
			}
			echo "<div class='d-flex w-100 justify-content-between'>";
			echo "<h5 class='font-weight-normal'>";
			if(get_issue_status($id) == "Done") {
				echo "<span class='badge badge-success'>Done</span> [$issue_project_key-$id] $issue_subject";
			} else if(get_issue_status($id) == "In Progress") {
				echo "<span class='badge badge-info'>In Progress</span> [$issue_project_key-$id] $issue_subject";
			} else if(get_issue_status($id) == "On Hold") {
				echo "<span class='badge badge-dark'>On Hold</span> [$issue_project_key-$id] $issue_subject";
			} else {
				echo "<span class='badge badge-primary'>Open</span> [$issue_project_key-$id] $issue_subject";
			}
			echo "</h5>";
			echo "<small>$issue_open_since ago</small>";
			echo "</div>";
			if(empty(get_issue_members($row['id']))) {
				echo "<small>Assignee(s): None";
				echo " | <i class='fal fa-comments'></i> ". get_issue_comment_count($row['id'])." Comments";
				echo "</small>";
			} else {
				$member_count = sizeof(get_issue_members($row['id'])); 
				echo "<small>Assignee(s): ";
				for($i=0; $i<=$member_count; $i++) {
					if($i <= ($member_count-2) && !empty(get_issue_members($row['id'])[$i])) {
						echo get_issue_members($row['id'])[$i].", ";
					} else {
						echo get_issue_members($row['id'])[$i];
					}
				}
				echo " | <i class='fal fa-comments'></i> ". get_issue_comment_count($row['id'])." Comments";
				echo "</small>";
			}
			echo "</a>";
		}
		echo "</div>";
	} else {
		echo "0 results";
	}
}
function assigned_issue_list($limit, $user_id, $issue_status, $issue_status2=NULL) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	include_once realpath(dirname(__FILE__)).'../libraries/general.php';
	if($issue_status2 != NULL) {
		$sql ="SELECT issue_members.issue_id, issues.issue_status FROM issue_members JOIN issues ON issue_members.issue_id = issues.id WHERE issue_members.issue_member_id='$user_id' AND issues.issue_status='$issue_status' OR issues.issue_status='$issue_status2' ORDER BY issue_members.issue_id LIMIT $limit";
	} else {
		$sql ="SELECT issue_members.issue_id, issues.issue_status FROM issue_members JOIN issues ON issue_members.issue_id = issues.id WHERE issue_members.issue_member_id='$user_id' AND issues.issue_status='$issue_status' ORDER BY issue_members.issue_id LIMIT $limit";
	}
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<div class='list-group'>";
		while($row = $result->fetch_assoc()) {
			$id = $row["issue_id"];
			$issue_subject = get_issue_subject($id);
			$issue_project_key = get_issue_project_key_from_issue_id($id);
			$issue_open_since = humanTiming(get_issue_open_timestamp($id));
			if(get_issue_status($id) == "Done") {
				echo "<a href='issue.php?id=$id' class='list-group-item list-group-item-action flex-column align-items-start issue-done'>";
			} else {
				echo "<a href='issue.php?id=$id' class='list-group-item list-group-item-action flex-column align-items-start'>";
			}
			echo "<div class='d-flex w-100 justify-content-between'>";
			echo "<h5 class='font-weight-normal'>";
			if(get_issue_status($id) == "Done") {
				echo "<span class='badge badge-success'>Done</span> [$issue_project_key-$id] $issue_subject";
			} else if(get_issue_status($id) == "In Progress") {
				echo "<span class='badge badge-info'>In Progress</span> [$issue_project_key-$id] $issue_subject";
			} else if(get_issue_status($id) == "On Hold") {
				echo "<span class='badge badge-dark'>On Hold</span> [$issue_project_key-$id] $issue_subject";
			} else {
				echo "<span class='badge badge-primary'>Open</span> [$issue_project_key-$id] $issue_subject";
			}
			echo "</h5>";
			echo "<small>$issue_open_since ago</small>";
			echo "</div>";
			if(empty(get_issue_members($row['issue_id']))) {
				echo "<small>Assignee(s): None";
				echo " | <i class='fal fa-comments'></i> ". get_issue_comment_count($row['id'])." Comments";
				echo "</small>";
			} else {
				$member_count = sizeof(get_issue_members($row['issue_id'])); 
				echo "<small>Assignee(s): ";
				for($i=0; $i<=$member_count; $i++) {
					if($i <= ($member_count-2) && !empty(get_issue_members($row['issue_id'])[$i])) {
						echo get_issue_members($row['issue_id'])[$i].", ";
					} else {
						echo get_issue_members($row['issue_id'])[$i];
					}
				}
				echo " | <i class='fal fa-comments'></i> ". get_issue_comment_count($row['id'])." Comments";
				echo "</small>";
			}
			echo "</a>";
		}
		echo "</div>";
	} else {
		echo "0 results";
	}
}
?>