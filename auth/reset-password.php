<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Reset Password to Fusion X Fame</title>
  <!-- loader-->
  <link href="../assets/css/pace.min.css" rel="stylesheet" />
  <script src="../assets/js/pace.min.js"></script>
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Custom Style-->
  <link href="../assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme4">

  <!-- Start wrapper-->
  <div id="wrapper">

    <div class="height-100v d-flex align-items-center justify-content-center">
      <div class="card card-authentication1 mb-0">
        <div class="card-body">
          <div class="card-content p-2">
            <div class="card-title text-uppercase pb-2">Reset Password</div>
            <?php
            if (@$_POST['post_password']) {
              $reset_email = $_POST['email'];
              $query = mysqli_query($conn, "SELECT * FROM user_data WHERE user_email = '$email'");
              if (mysqli_num_rows($query) > 0) {
                EMail($reset_email, 'Your Reset-Password Link', 'http://localhost/myfame/auth/reset.php?user_email=' . $reset_email . '');
              } else {
                Toast('danger', 'No Email Found ..');
              }
            }
            ?>
            <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
            <form method="post" action="./reset-password.php">
              <div class="form-group">
                <label for="exampleInputEmailAddress" class="">Email Address</label>
                <div class="position-relative has-icon-right">
                  <input type="email" id="exampleInputEmailAddress" name="email" class="form-control input-shadow" placeholder="Email Address">
                  <div class="form-control-position">
                    <i class="icon-envelope-open"></i>
                  </div>
                </div>
              </div>

              <button type="button" class="btn btn-light btn-block mt-3">Reset Password</button>
            </form>
          </div>
        </div>
        <div class="card-footer text-center py-3">
          <p class="text-warning mb-0">Return to the <a href="login.php"> Sign In</a></p>
        </div>
      </div>
    </div>

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--start color switcher-->
    <!--end color switcher-->

  </div><!--wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>

  <!-- sidebar-menu js -->
  <script src="../assets/js/sidebar-menu.js"></script>

  <!-- Custom scripts -->
  <script src="../assets/js/app-script.js"></script>


</body>

</html>