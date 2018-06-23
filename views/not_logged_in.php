<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>IssueCycle</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="libraries/css/fontawesome-all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
</head>

<body>

    <main role="main" class="container">
        <div style="padding-bottom: 50px"></div>
        <div class="card">
            <div class="card-body">
                <center><h5 class="card-title"><i class="fal fa-bicycle"></i> IssueCycle</h5></center>
                <hr>
                <?php
                // show potential errors / feedback (from login object)
                if (isset($login)) {
                    if ($login->errors) {
                        foreach ($login->errors as $error) {
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                            echo $error;
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>";
                            echo "</div>";
                        }
                    }
                    if ($login->messages) {
                        foreach ($login->messages as $message) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                            echo $message;
                            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>";
                            echo "</div>";
                        }
                    }
                }
                session_start();
                $_SESSION['POST_login_url'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                ?>
                <form method="post" action="index.php" name="loginform">
                    <div class="form-group">
                        <input placeholder="Username" class="form-control" type="text" name="user_name" required>
                    </div>
                    <div class="form-group">
                        <input placeholder="Password" class="form-control" type="password" name="user_password" autocomplete="off" required>
                    </div>
                    <center><input type="submit"  class="btn btn-primary mb-2" name="login" value="Log in"></center>
                </form>
            </div>
        </div>      

    </main><!-- /.container -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>