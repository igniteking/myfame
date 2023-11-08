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
                                                            <th>User Name</th>
                                                            <th>User Emaiml</th>
                                                            <th>User Code</th>
                                                            <th>Referal Code</th>
                                                            <th>Action (s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $get_orders = mysqli_query($conn, "SELECT * FROM user_data WHERE user_type = 'user' ORDER BY id DESC");
                                                        while ($row = mysqli_fetch_array($get_orders)) {
                                                            $user_get_id = $row['id'];
                                                            $user_name = $row['user_name'];
                                                            $user_email = $row['user_email'];
                                                            $code = $row['code'];
                                                            $my_code = $row['mycode'];
                                                            $created_at = $row['created_at'];
                                                            echo '
                                                    <tr>
                                                    <td>' . $user_get_id . '</td>
                                                <td class="text-bold-500">' . $user_name . '</td>
                                                <td>' . $user_email . '</td>
                                                <td>' . $my_code . '</td>
                                                <td>' . $code . '</td>
                                                <td>' . $created_at . '</td>
                                                <td>
                                                <button hx-get="./helpers/delete_users.php?req_id=' . $user_get_id . '" hx-trigger="click" hx-target="#notify" class="btn icon btn-danger">Delete</button>
                                                </td>
                                                </tr>
                                                ';
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