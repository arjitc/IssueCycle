<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="index.php"><i class="fal fa-bicycle"></i> IssueCycle</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-briefcase"></i> Projects</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<?php
					include realpath(dirname(__FILE__)).'/../config/db.php';
					$sql = "SELECT id, project_name FROM `projects`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$id = $row["id"];
							echo "<a class='dropdown-item' href='project.php?id=$id'>".$row["project_name"]."</a>";
						}
					} else {
						echo "<a class='dropdown-item'>No Projects Found</a>";
					}
					?>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="new_project.php">New Project</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="timeline.php"><i class="fal fa-chess-clock"></i> Timeline</span></a>
			</li>
			<li class="nav-item">
				<?php
				if($_SERVER['PHP_SELF'] == "/project.php") {
					$project_id = $_GET['id'];
				}
				?>
				<a class="nav-link" href="open_issue.php<?php if(!empty($project_id)) echo "?id=$project_id"; ?>"><i class="fal fa-plus-circle"></i> Open New Issue</span></a>
			</li>
		</ul>
		<ul class="navbar-nav mr-3">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-cog"></i></a>
				<div class="dropdown-menu" aria-labelledby="dropdown02">
					<a class="dropdown-item" href="account.php"><i class="fal fa-user-cog"></i> Account</a>
					<a class="dropdown-item" href="index.php?logout"><i class="fal fa-sign-out"></i> Logout</a>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0" action="search.php" method="post">
			<input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
</nav>