<?php include('./connections/connection.php') ?>
<?php include('./connections/global.php') ?>
<?php include('./connections/functions.php') ?>
<?php include('./components/header.php') ?>

<body class="bg-theme bg-theme4">

    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Start sidebar-wrapper-->
        <?php include('./components/sidebar.php') ?>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <?php include('./components/top_bar.php') ?>

        <!--End topbar header-->

        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">

                <!--Start Dashboard Content-->

                <div class="page-heading">
                    <h3>Widthrawl Request</h3>
                </div>
                <div class="page-content">
                    <section class="h-100 gradient-custom-2">
                        <div class="container py-5 h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Widthrawl Request</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <?php
                                                if (@$_GET['code'] == 1) {
                                                    Toast(
                                                        "success",
                                                        "Order Created Succesfully ..."
                                                    );
                                                }
                                                $reg = @$_POST['request'];
                                                if ($reg) {
                                                    $quantity = security_check(@$_POST['quantity']);
                                                    $created_at = date("Y-m-d H:i:s");
                                                    $insert_request = mysqli_query($conn, "INSERT INTO `widthrawl_request`(`id`, `user_id`, `amount`, `status`, `created_at`) VALUES
                                                         (NULL,'$user_id','$quantity','pending','$created_at')");
                                                    if ($insert_request) {
                                                        echo "<meta http-equiv=\"refresh\" content=\"0; url=./add_request.php?code=1\">";
                                                    }
                                                }


                                                ?>
                                                <form class="form form-horizontal" method="post" action="./add_request.php">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Amount</label>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <input type="number" max="<?= fetch_single_row($conn, "SELECT amount FROM `refral_wallet` WHERE user_id = '$user_id'"); ?>" class="form-control" name="quantity">
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <input type="submit" class="btn btn-primary me-1 mb-1" name="request" value="Submit"></input>
                                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                            </div><br>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Bank Details</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <?php
                                            if (@$_GET['code'] == 2) {
                                                Toast(
                                                    "success",
                                                    "Details Saved Succesfully ..."
                                                );
                                            }
                                            $indesert = @$_POST['indesert'];
                                            if ($indesert) {
                                                $acc_holder_name = security_check(@$_POST['acc_holder_name']);
                                                $acc_number = security_check(@$_POST['acc_number']);
                                                $bank_name = security_check(@$_POST['bank_name']);
                                                $ifsc_code = security_check(@$_POST['ifsc_code']);
                                                $created_at = date("Y-m-d H:i:s");
                                                $insert_request = mysqli_query($conn, "INSERT INTO `bank_details`(`id`, `user_id`, `acc_holder_name`, `acc_number`, `bank_name`, `ifsc_code`, `created_at`) VALUES 
                                                (NULL,'$user_id', '$acc_holder_name','$acc_number','$bank_name','$ifsc_code','$created_at')");
                                                if ($insert_request) {
                                                    echo "<meta http-equiv=\"refresh\" content=\"0; url=./add_request.php?code=2\">";
                                                }
                                            }


                                            ?>
                                            <form class="form form-horizontal" method="post" action="./add_request.php">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Account Holder Name</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <div class="form-group">
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control" name="acc_holder_name">
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        <div class="col-md-12">
                                                            <label>Account Number</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <div class="form-group">
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control" name="acc_number">
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        <div class="col-md-12">
                                                            <label>Bank Name</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <div class="form-group">
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control" name="bank_name">
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        <div class="col-md-12">
                                                            <label>IFSC Code</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <div class="form-group">
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control" name="ifsc_code">
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <input type="submit" class="btn btn-primary me-1 mb-1" name="indesert" value="Submit"></input>
                                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                        </div><br>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!--End Dashboard Content-->

                <!--start overlay-->
                <div class="overlay toggle-menu"></div>
                <!--end overlay-->

            </div>
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <?php include('./components/footer.php') ?>