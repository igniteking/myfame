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
                    <h3>Widthrawl Request List</h3>
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
                                                            <th>Status</th>
                                                            <th>Amount</th>
                                                            <th>Account Holder Name</th>
                                                            <th>Account Number</th>
                                                            <th>Bank Name</th>
                                                            <th>IFSC Code</th>
                                                            <th>Action (s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $get_orders = mysqli_query($conn, "SELECT * FROM widthrawl_request ORDER BY id DESC");
                                                        while ($row = mysqli_fetch_array($get_orders)) {
                                                            $order_id = $row['id'];
                                                            $amount = $row['amount'];
                                                            $get_user_id = $row['user_id'];
                                                            $oreder_username = fetch_single_row($conn, "SELECT user_name FROM user_data WHERE id = '$get_user_id'");
                                                            $get_statuss = $row['status'];
                                                            if ($get_statuss == 'pending') {
                                                                $statuss = '<button class="btn btn-warning">pending</button>';
                                                            } else if ($get_statuss == 'completed') {
                                                                $statuss = '<button class="btn btn-success">success</button>';
                                                            } else {
                                                                $statuss = '<button class="btn btn-danger">rejected</button>';
                                                            }
                                                            $get_orders = mysqli_query($conn, "SELECT * FROM bank_details WHERE user_id = '$get_user_id'");
                                                            while ($row = mysqli_fetch_array($get_orders)) {
                                                                $acc_holder_name = $row['acc_holder_name'];
                                                                $acc_number = $row['acc_number'];
                                                                $bank_name = $row['bank_name'];
                                                                $ifsc_code = $row['ifsc_code'];

                                                                echo '
                                                    <tr>
                                                    <td>' . $order_id . '</td>
                                                <td>' . $oreder_username . '</td>
                                                <td>' . $statuss . '</td>
                                                <td>' . $amount . '</td>
                                                <td>' . $acc_holder_name . '</td>
                                                <td>' . $acc_number . '</td>
                                                <td>' . $bank_name . '</td>
                                                <td>' . $ifsc_code . '</td>
                                                <td>';
                                                                if ($get_statuss == 'pending') {
                                                                    echo '  <button hx-get="./helpers/widthrawl_status.php?req_id=' . $order_id . '&status=accept&get_user_id=' . $get_user_id . '" hx-trigger="click" hx-target="#notify" class="btn icon btn-success">Accept</button>
                                                                    <button hx-get="./helpers/widthrawl_status.php?req_id=' . $order_id . '&status=reject&get_user_id=' . $get_user_id . '" hx-trigger="click" hx-target="#notify" class="btn icon btn-danger">Reject</button>
                                                                        ';
                                                                } else {
                                                                    echo '</td>
                                                </tr>
                                                ';
                                                                }
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