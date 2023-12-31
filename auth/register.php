<?php include("../connections/connection.php"); ?>
<?php include("../connections/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register to Fusion X Fame</title>
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme4">

    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">

        <div class="card card-authentication1 mx-auto my-4">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="../assets/images/logo-icon.png" alt="logo icon">
                    </div>
                    <div class="card-title text-uppercase text-center py-3">Sign Up</div>
                    <?php
                    if (@$_GET['status'] == 1) {
                        echo "<div class='row'><div class='col-md-12 btn btn-success mb-4'>You can now login to your account!</div></div>";
                    }
                    $reg = @$_POST['reg'];
                    if ($reg) {
                        $email = security_check(@$_POST['email']);
                        $username = security_check(@$_POST['username']);
                        $password = security_check(@$_POST['password']);
                        $re_pass = security_check(@$_POST['re-pass']);
                        $user_type = "user";
                        $code = security_check(@$_GET['code']);
                        if ($code == '') {
                            $code = '';
                        } else {
                            $code = security_check(@$_GET['code']);
                        }
                        $ip = getenv("REMOTE_ADDR");
                        Register($user_type, $username, $password, $re_pass, $conn, $email, $code);
                    }
                    ?>
                    <form method="post" action="./register.php?code=<?= @$_GET['code'] ?>">
                        <div class="form-group">
                            <label for="exampleInputName" class="sr-only">Name</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="exampleInputName" name="username" class="form-control input-shadow" placeholder="Enter Your Name">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmailId" class="sr-only">Email ID</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="exampleInputEmailId" name="email" class="form-control input-shadow" placeholder="Enter Your Email ID">
                                <div class="form-control-position">
                                    <i class="icon-envelope-open"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="exampleInputPassword" name="password" class="form-control input-shadow" placeholder="Choose Password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Re-Type Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="exampleInputPassword" name="re-pass" class="form-control input-shadow" placeholder="Choose Password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="icheck-material-white">
                                <input type="checkbox" id="user-checkbox" checked="" />
                                <label for="user-checkbox">I Agree With Terms & Conditions</label>
                            </div>
                        </div>

                        <input type="submit" value="Sign Up" name="reg" class="btn btn-light btn-block waves-effect waves-light"></input>
                    </form>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-warning mb-0">Already have an account? <a href="login.php"> Sign In here</a></p>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

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