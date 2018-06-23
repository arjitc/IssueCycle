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

  <main role="main" class="container-fluid">

    <h2>Open New Issue</h2>
    <hr>
    <div class="row">
      <div class="col-8">
        <form action="open_issue_db.php" method="post" id="open_new_issue_form">
          <input type="text" class="form-control" name="issue_subject" placeholder="Issue Subject">
          <br>
          <textarea id="summernote" name="issue_body"></textarea><hr>
          <center><input type="submit" class="btn btn-primary"></center>
        </div>
        <div class="col-4">
          <h5>Project</h5>
          <hr>
          <?php
          $sql = "SELECT * FROM `projects`";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo "<select class='form-control' name='issue_project_id' form='open_new_issue_form'>";
            if(!empty($_GET['id'])) {
              $project_id = $_GET['id'];
              $project_name = get_project_name_from_project_id($_GET['id']);
              echo "<option value='$project_id'>$project_name</option>";
            }
            while($row = $result->fetch_assoc()) {
              $id = $row["id"];
              $project_name = $row["project_name"];
              echo "<option value='$id'>$project_name</option>";
            }
            echo "</select>";
          } else {
            echo "0 results";
          }
          ?>
          <hr>
          <h5>Issue Status</h5>
          <hr>
          <select class="form-control" name="issue_status" form="open_new_issue_form">
            <option value="Open">Open</option>
            <option value="In Progress">In Progress</option>
            <option value="On Hold">On Hold</option>
            <option value="Awaiting Review">Awaiting Review</option>
            <option value="Done">Done</option>
          </select>
          <hr>
          <h5>Issue ETC</h5>
          <hr>
          <input class="form-control" type="date" data-date-inline-picker="true" name="issue_etc">
        </form>
      </div>
    </div>
  </main><!-- /.container -->

  <?php include 'libraries/js.php'; ?>
</body>
</html>