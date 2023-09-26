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
                    <h3>Add Order</h3>
                </div>
                <div class="page-content">
                    <section class="h-100 gradient-custom-2">
                        <div class="container py-5 h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Add Order</h4>
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
                                                    $get_amount = fetch_single_row($conn, "SELECT amount from main_wallet WHERE user_id = '$user_id'");
                                                    $amount = security_check(@$_POST['amount']);
                                                    $quantity = security_check(@$_POST['quantity']);
                                                    $deduct = $quantity * $amount;
                                                    if ($get_amount >= $deduct) {
                                                        $category_id = security_check(@$_POST['category_id']);
                                                        $category_name = fetch_single_row($conn, "SELECT * FROM categories WHERE id = '$category_id'");
                                                        $package_name = security_check(@$_POST['package_id']);
                                                        $link = security_check(@$_POST['link']);
                                                        $created_at = date("Y-m-d H:i:s");
                                                        $reward = getPercent('1', $deduct);
                                                        $insert_request = mysqli_query($conn, "INSERT INTO `orders`(`id`, `category_name`, `package_name`, `amount`, `user_id`, `status`, `code`,`reward`, `created_at`, `link`, `quantity`) 
                                                        VALUES (NULL,'$category_name','$package_name','$amount','$user_id','0','$refered_code' ,'$reward','$created_at', '$link', '$quantity')");


                                                        $insert_wallet = mysqli_query($conn, "INSERT INTO `wallet`(`id`, `amount`, `reference_id`, `user_id`, `created_at`, `status` ) VALUES 
                                                        (NULL,'$deduct','','$user_id','$created_at', 'deducted')");
                                                        $get_main = fetch_single_row($conn, "SELECT amount FROM main_wallet WHERE user_id = '$user_id'");
                                                        $new_deduct = $get_amount - $deduct;
                                                        $main_wallet_update = mysqli_query($conn, "UPDATE main_wallet SET amount = '$new_deduct' WHERE user_id = '$user_id'");
                                                        if ($main_wallet_update) {
                                                            echo "<meta http-equiv=\"refresh\" content=\"0; url=./add_order.php?code=1\">";
                                                        }
                                                    } else {
                                                        Toast(
                                                            "warning",
                                                            "Insufficient Funds  ..."
                                                        );
                                                    }
                                                }


                                                ?>
                                                <form class="form form-horizontal" method="post" action="./add_order.php">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Category Name</label>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <select hx-get="./helpers/get_package.php" hx-trigger="change click" hx-target="#package_id" hx-include="[id='category_id']" name="category_id" class="form-control" id="category_id">
                                                                        <div class="position-relative">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            $get_categories = mysqli_query($conn, "SELECT * FROM `categories` LIMIT 9");
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
                                                            <div class="col-md-12">
                                                                <label>Package</label>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <select class="form-control" hx-get="./helpers/get_quantity.php" hx-trigger="change click" hx-target="#options" hx-include="[id='package_id']" name="package_id" id="package_id">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Quantity</label>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <input type="number" onkeyup="calculate(this.value)" id="" class="form-control" name="quantity">
                                                                    </div>
                                                                </div>
                                                                <div id="total_price"></div>
                                                                <div id="options"></div>
                                                                <script>
                                                                    function calculate(quantity) {
                                                                        var amount = parseInt(document.getElementById('amount').value);
                                                                        var total = amount * quantity;
                                                                        console.log(total);
                                                                        console.log(amount);
                                                                        document.getElementById('total_price').innerText = total;
                                                                    }
                                                                </script>
                                                            </div><br>
                                                            <div class="col-md-12">
                                                                <label>Link</label>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <div class="position-relative">
                                                                        <input type="link" class="form-control" name="link">
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