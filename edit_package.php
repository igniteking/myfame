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
                    <h3>Edit Package</h3>
                </div>
                <div class="page-content">
                    <section class="h-100 gradient-custom-2">
                        <div class="container py-5 h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Edit Package</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <?php
                                                $pack_id = $_GET['pack_id'];
                                                $reg = @$_POST['request'];
                                                if ($reg) {
                                                    $package_name = security_check(@$_POST['package_name']);
                                                    $package_discription = security_check(@$_POST['package_discription']);
                                                    $amount = security_check(@$_POST['amount']);
                                                    $category_id = security_check(@$_POST['category_id']);
                                                    $min_quanitity = security_check(@$_POST['min_quanitity']);
                                                    $created_at = date("Y-m-d H:i:s");
                                                    $insert_request = mysqli_query($conn, "UPDATE `package` SET `package_description`='$package_discription',`package_name`='$package_name', `category_id`='$category_id',`amount`='$amount',`min_quanitity`='$min_quanitity'  WHERE id = '$pack_id'");

                                                    if ($insert_request) {
                                                        echo "<meta http-equiv=\"refresh\" content=\"0; url=./edit_package.php?pack_id=$pack_id&&code=1\">";
                                                    }
                                                }
                                                if (@$_GET['code'] == 1) {
                                                    Toast(
                                                        "success",
                                                        "Updated Succesfully.."
                                                    );
                                                }

                                                ?>
                                                <form class="form form-horizontal" method="post" action="./edit_package.php?pack_id=<?= $pack_id ?>">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Package Name</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group has-icon-left">
                                                                    <div class="position-relative">
                                                                        <input type="text" class="form-control" value="<?= fetch_single_row($conn, "SELECT `package_name` FROM package WHERE id = '$pack_id'") ?>" name="package_name" placeholder="Package Name" id="first-name-icon">
                                                                        <div class="form-control-icon">
                                                                            <i class="bi bi-receipt"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Package Discription</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <textarea type="text" class="form-control" name="package_discription" id="first-name-icon"><?= fetch_single_row($conn, "SELECT `package_description` FROM package WHERE id = '$pack_id'") ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Category</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <select name="category_id" class="form-control" id="">
                                                                            <option value="<?= fetch_single_row($conn, "SELECT `category_id` FROM package WHERE id = '$pack_id'") ?>"><?= fetch_single_row($conn, "SELECT `package_description` FROM package WHERE id = '$pack_id'") ?></option>

                                                                            <?php
                                                                            $get_categories = mysqli_query($conn, "SELECT * FROM `categories`");
                                                                            while ($rows = mysqli_fetch_array($get_categories)) {
                                                                                $category_id = $rows["id"];
                                                                                $category_name = $rows["category_name"];
                                                                                echo '
                                                                            <option value="' . $category_id . '">' . $category_name . '</option>
                                                                        ';
                                                                            } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Package Amount</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <input type="number" class="form-control" value="<?= fetch_single_row($conn, "SELECT `amount` FROM package WHERE id = '$pack_id'") ?>" min="0.1" step="0.1" name="amount" placeholder="Quantity (1 item) /Amount" id="first-name-icon">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Minimum Quantity</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <input type="number" class="form-control" value="<?= fetch_single_row($conn, "SELECT `min_quanitity` FROM package WHERE id = '$pack_id'") ?>" min="0.1" step="0.1" name="min_quanitity" placeholder="Minimum Quanitity" id="first-name-icon">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <input type="submit" class="btn btn-primary me-1 mb-1" name="request" value="Submit"></input>
                                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                            </div>
                                                        </div>
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