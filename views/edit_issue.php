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

    <h2>Editing - [<?php echo get_issue_project_key_from_issue_id($_GET['id'])."-".$_GET['id']; ?>] <?php echo get_issue_subject($_GET['id']); ?></h2>
    <hr>

    <form action="edit_issue_db.php" method="post" id="open_new_issue_form">
      <input type="hidden" name="issue_id" value="<?php echo $_GET['id']; ?>">
      <textarea id="summernote" name="issue_body"><?php echo get_issue_body($_GET['id']); ?></textarea><hr>
      <center><input type="submit" class="btn btn-primary"></center>
    </form>
  </main><!-- /.container -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#summernote').summernote({
        height: 500,
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