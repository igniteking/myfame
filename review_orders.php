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
                    <h3>Order List</h3>
                </div>
                <div class="page-content">
                    <!-- Hoverable rows start -->
                    <section class="section">
                        <div class="row" id="table-hover-row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <!-- table hover -->
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Category Name</th>
                                                            <th>Package Name</th>
                                                            <th>Price Paid</th>
                                                            <th>User Name</th>
                                                            <th>Status</th>
                                                            <th>Code</th>
                                                            <th>Link</th>
                                                            <th>Reward</th>
                                                            <th>Quantity</th>
                                                            <th>Amount / item</th>
                                                            <th>Action (s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $get_orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
                                                        while ($row = mysqli_fetch_array($get_orders)) {
                                                            $order_id = $row['id'];
                                                            $category_name = $row['category_name'];
                                                            $package_name = $row['package_name'];
                                                            $amount = $row['amount'];
                                                            $get_user_id = $row['user_id'];
                                                            $oreder_username = fetch_single_row($conn, "SELECT user_name FROM user_data WHERE id = '$get_user_id'");
                                                            $get_statuss = $row['status'];
                                                            $code = $row['code'];
                                                            $link = $row['link'];
                                                            $reward = $row['reward'];
                                                            $quantity = $row['quantity'];
                                                            $created_at = $row['created_at'];
                                                            $total = $amount * $quantity;
                                                            if ($get_statuss == 0) {
                                                                $statuss = '<button class="btn btn-warning">pending</button>';
                                                            } else if ($get_statuss == 1) {
                                                                $statuss = '<button class="btn btn-success">complete</button>';
                                                            } else {
                                                                $statuss = '<button class="btn btn-danger">rejected</button>';
                                                            }
                                                            echo '
                                                    <tr>
                                                    <td>' . $order_id . '</td>
                                                <td class="text-bold-500">' . $category_name . '</td>
                                                <td>' . $package_name . '</td>
                                                <td>' . $total . '</td>
                                                <td>' . $oreder_username . '</td>
                                                <td>' . $statuss . '</td>
                                                <td>' . $code . '</td>
                                                <td><a target="_blank" href="' . $link . '">' . $link . '</a></td>
                                                <td>' . $reward . '</td>
                                                <td>' . $amount . '</td>
                                                <td>' . $created_at . '</td>
                                                <td>';
                                                            if ($get_statuss == 0) {
                                                                echo '  <button hx-get="./helpers/order_status.php?req_id=' . $order_id . '&status=accept&code=' . $code . '&get_user_id=' . $get_user_id . '&reward=' . $reward . '" hx-trigger="click" hx-target="#notify" class="btn icon btn-success">Accept</button>
                                                                    <button hx-get="./helpers/order_status.php?req_id=' . $order_id . '&status=reject&amount=' . $total . '&get_user_id=' . $get_user_id . '" hx-trigger="click" hx-target="#notify" class="btn icon btn-danger">Reject</button>
                                                                        ';
                                                            } else {
                                                                echo '</td>
                                                </tr>
                                                ';
                                                            }
                                                        }
                                                        ?>
                                                        <!-- <button hx-get="./helpers/order_status.php?req_id=' . $order_id . '&status=reject" hx-trigger="click" hx-target="#notify" class="btn icon btn-danger"><i class="bi bi-x-lg"></i></button> -->
                                                        <div id="notify"></div>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                    <!-- Hoverable rows end -->
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