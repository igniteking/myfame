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
                    <h3>Funds List</h3>
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
                                                            <th>Amount</th>
                                                            <th>Reference Id</th>
                                                            <th>Status</th>
                                                            <th>User Name</th>
                                                            <th>Date</th>
                                                            <th>Action (s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $get_orders = mysqli_query($conn, "SELECT * FROM wallet WHERE status = 'pending' OR status = 'success' or status = 'rejected' ORDER BY id DESC");
                                                        while ($row = mysqli_fetch_array($get_orders)) {
                                                            $wallet_id = $row['id'];
                                                            $amount = $row['amount'];
                                                            $reference_id = $row['reference_id'];
                                                            $get_status = $row['status'];
                                                            $wallet_user = $row['user_id'];
                                                            $user_name_wallet = fetch_single_row($conn, "SELECT user_name FROM user_data WHERE id = '$wallet_user'");
                                                            $created_at = $row['created_at'];
                                                            if ($get_status == 'pending') {
                                                                $status = '<button class="btn btn-warning">pending</button>';
                                                            } else if ($get_status == 'success') {
                                                                $status = '<button class="btn btn-success">success</button>';
                                                            } else {
                                                                $get_status = '<button class="btn btn-danger">rejected</button>';
                                                            }
                                                            echo '
                                                    <tr>
                                                    <td>' . $wallet_id . '</td>
                                                <td class="text-bold-500">' . $amount . '</td>
                                                <td>' . $reference_id . '</td>
                                                <td>' . $status . '</td>
                                                <td>' . $user_name_wallet . '</td>
                                                <td>' . $created_at . '</td>
                                                <td>';
                                                            if ($get_status == 'pending') {
                                                                echo '<button hx-get="./helpers/wallet.php?req_id=' . $wallet_id . '&status=accept&get_user_id=' . $wallet_user . '&amount=' . $amount . '" hx-trigger="click" hx-target="#notify" class="btn btn-success">Accept</button>
                                                <button hx-get="./helpers/wallet.php?req_id=' . $wallet_id . '&status=reject" hx-trigger="click" hx-target="#notify" class="btn icon btn-danger">Reject</button>
                                                ';
                                                            } else {
                                                                echo ' </td>
                                                </tr>
                                                ';
                                                            }
                                                        }
                                                        ?>
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