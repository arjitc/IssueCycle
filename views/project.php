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
  <div class="container-fluid">   
    <main role="main" class="col-md-9 col-lg-9 px-4">
      <h2 class="font-weight-normal">
        [<?php echo get_project_key_from_project_id($_GET['id']); ?>] <?php echo get_project_name_from_project_id($_GET['id']); ?>
      </h2>
      <hr>
      <div class="list-group">
        <?php
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        if($_GET['filter']) {
          switch ($_GET['filter']) {
            case 'Open':
            $filter = "Open";
            break;
            case 'Done':
            $filter = "Done";
            break;
            case 'In Progress':
            $filter = "In Progress";
            break;
            case 'Awaiting Review':
            $filter = "Awaiting Review";
            break;
            case 'On Hold':
            $filter = "On Hold";
            break;
            default:
            $filter = "Open";
            break;
          }
          $sql = "SELECT * FROM `issues` WHERE `issue_project_id`='$id' AND `issue_status`='$filter' ORDER BY `id` DESC";
        } else {
          $sql = "SELECT * FROM `issues` WHERE `issue_project_id`='$id' AND `issue_status`='Open' ORDER BY `id` DESC";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $issue_subject = $row["issue_subject"];
            $issue_body = $row["issue_body"];
            $issue_project_key = get_issue_project_key_from_issue_id($row['id']);
            $issue_open_since = humanTiming(get_issue_open_timestamp($row['id']));
            if(get_issue_status($id) == "Done") {
              echo "<a href='issue.php?id=$id' class='list-group-item list-group-flush list-group-item-action flex-column align-items-start issue-done'>";
            } else {
              echo "<a href='issue.php?id=$id' class='list-group-item list-group-flush list-group-item-action flex-column align-items-start'>";
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
                if($member_count == 1) {
                  echo get_issue_members($row['id'])[$i];
                } else {
                  echo get_issue_members($row['id'])[$i].", ";
                }

              }
              echo "</small>";
            }
            echo "</a>";
          }
        } else {
          echo "<div class='card-body'>";
          echo "No issue(s) found.";
          echo "</div>";
        }
        ?>
      </div>


    </main>
    <nav class="col-md-3 d-none d-md-block sidebar">
      <div class="card">
        <div class="card-header">
          Filter Issues
        </div>
        <ul class="list-group list-group-flush">
          <?php 
          $project_id = $_GET['id']; 
          ?>
          <a class="list-group-item" href='project.php?id=<?php echo $_GET['id']; ?>&filter=Open'>
            <?php if($_GET['filter'] == "Open" || empty($_GET['filter'])) { echo "<i class='fal fa-check'></i>"; } ?>
            Open
          </a>
          <a class="list-group-item" href="project.php?id=<?php echo $_GET['id']; ?>&filter=Done">
            <?php if($_GET['filter'] == "Done") { echo "<i class='fal fa-check'></i>"; } ?>
            Done
          </a>
          <a class="list-group-item" href="project.php?id=<?php echo $_GET['id']; ?>&filter=In Progress">
            <?php if($_GET['filter'] == "In Progress") { echo "<i class='fal fa-check'></i>"; } ?>
            In Progress
          </a>
          <a class="list-group-item" href="project.php?id=<?php echo $_GET['id']; ?>&filter=On Hold">
            <?php if($_GET['filter'] == "On Hold") { echo "<i class='fal fa-check'></i>"; } ?>
            On Hold
          </a>
          <a class="list-group-item" href="project.php?id=<?php echo $_GET['id']; ?>&filter=Awaiting Review">
            <?php if($_GET['filter'] == "Awaiting Review") { echo "<i class='fal fa-check'></i>"; } ?>
            Awaiting Review
          </a>
        </ul>
      </div>
    </nav>
  </div><!-- /.container -->
  <?php include 'libraries/js.php'; ?>
</body>
</html>