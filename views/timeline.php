<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>IssueCycle</title>

	<?php
	include 'libraries/general.php';
	include 'libraries/css.php'; 
	?>
</head>

<body>
	<?php include 'libraries/header.php'; ?>
	<div class="pushdown70px"></div>
	<div class="container-fluid">
		<main role="main" class="container-fluid">
			<?php 
			function issue_eta_progress($due_date) {
				$today = date("d");
				return round(($today/$due_date)*100);
			}
			?>
			<?php 
			include 'config/db.php';
			echo "<table class='table table-bordered'>";
			echo "<tr>";
			for($i=1; $i<=date("t"); $i++) {
				echo "<td><center>$i</center></td>";
			}
			echo "</tr>";
			$sql = "SELECT * FROM `issues` WHERE `issue_status`!='Done' AND `issue_etc`!='' ORDER BY `issue_etc` ASC";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$id = $row['id'];
					$issue_status = $row['issue_status'];
					$issue_subject = $row['issue_subject'];
					$timestamp = strtotime($row['issue_etc']);
					$formattedDate = date('d', $timestamp);
					$issue_etc = date('F d, Y', $timestamp);
					echo "<tr>";
					echo "<td colspan='$formattedDate'>";
					$due_date = issue_eta_progress($formattedDate);
					if($issue_status == "In Progress") {
						$class = "progress-bar progress-bar-striped progress-bar-animated bg-success";
					} else if($formattedDate < date('d')) {
						$class = "progress-bar bg-warning";
					} else {
						$class = "progress-bar";
					}
					echo "<a href='issue.php?id=$id'><div class='progress' style='height: 30px;'>
					<div class='$class' role='progressbar' style='width: $due_date%;' aria-valuenow='$due_date' aria-valuemin='0' aria-valuemax='100'>$issue_subject ($issue_etc)</div>
					</div></a>";
					echo "</td>";
					echo "</tr>";
				}
			}
			
			
			echo "</table>";
			?>
		</main><!-- /.container -->

		<?php include 'libraries/js.php'; ?>
	</body>
	</html>