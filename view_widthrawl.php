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
                    <h3>Widthrawl List</h3>
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
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $get_requests = mysqli_query($conn, "SELECT * FROM widthrawl_request WHERE user_id = '$user_id' ORDER BY id DESC");
                                                        while ($row = mysqli_fetch_array($get_requests)) {
                                                            $wallet_id = $row['id'];
                                                            $amount = $row['amount'];
                                                            $status = $row['status'];
                                                            $created_at = $row['created_at'];
                                                            if ($status == 'pending') {
                                                                $status = '<button class="btn btn-warning">pending</button>';
                                                            } else if ($status == 'success') {
                                                                $status = '<button class="btn btn-success">success</button>';
                                                            } else if ($status == 'deducted') {
                                                                $status = '<button class="btn btn-info">deducted</button>';
                                                            } else {
                                                                $status = '<button class="btn btn-danger">rejected</button>';
                                                            }
                                                            echo '
                                                            <tr>
                                                                <td>' . $wallet_id . '</td>
                                                                <td class="text-bold-500">' . $amount . '</td>
                                                                <td>' . $status . '</td>
                                                                <td>' . $created_at . '</td>
                                                            </tr>
                                                        ';
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