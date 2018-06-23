<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>IssueCycle</title>

  <?php 
  include 'libraries/general.php';
  include 'libraries/css.php'; 
  include 'libraries/Parsedown.php';
  $Parsedown = new Parsedown();
  ?>
</head>

<body>

  <?php include 'libraries/header.php'; ?>
  <div class="pushdown70px"></div>

  <main role="main" class="container-fluid">

    <h2>[<?php echo get_issue_project_key_from_issue_id($_GET['issue_id'])."-".$_GET['issue_id']; ?>] <?php echo get_issue_subject($_GET['issue_id']); ?> - Replying to message,</h2>
    <hr>
    <div class="row">
      <div class="col-8">
        <?php echo $Parsedown->text(get_issue_comment_from_comment_id($_GET['id'])); ?>
        <hr>
        <form action="issue_comment_db.php" method="post">
          <input type="hidden" name="issue_id" value="<?php echo $_GET['issue_id']; ?>">
          <textarea id="summernote" name="issue_comment"><div class="card card-body"><?php echo get_issue_comment_from_comment_id($_GET['id']); ?></div> <hr>Your Comment Here</textarea>
          <hr>
          <center><input type="submit" class="btn btn-primary"></center>
        </form>
      </div>
      <div class="col-4">
        <h5>Assignee(s)</h5>
        <hr>
        None
        <hr>
        <h5>Submitted On</h5>
        <hr>
        <?php echo date('d/m/Y H:i:s', get_issue_open_timestamp($_GET['issue_id'])); ?>
        <hr>
        <h5>Submitted By</h5>
        <hr>
        <?php echo get_user_name_from_user_id(get_issue_submitter($_GET['issue_id'])); ?>
        <hr>
        <h5>Issue Status</h5>
        <hr>

      </div>
    </div>
  </main><!-- /.container -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#summernote').summernote({
        height: 300,
        toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table']
        ]
      });
    });
  </script>
</body>
</html>