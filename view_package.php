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
                    <h3>Package List</h3>
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
                                                            <th>Sub Category Name</th>
                                                            <th>Discription</th>
                                                            <th>Date</th>
                                                            <th>Action (s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $get_requests = mysqli_query($conn, "SELECT * FROM package ORDER BY id DESC");
                                                        while ($row = mysqli_fetch_array($get_requests)) {
                                                            $req_id = $row['id'];
                                                            $category_name = $row['package_name'];
                                                            $category_description = $row['package_description'];
                                                            $category_id = $row['category_id'];
                                                            $category_name = fetch_single_row($conn, "SELECT category_name FROM categories WHERE id = $category_id");
                                                            $created_at = $row['created_at'];
                                                            echo '
                                                    <tr>
                                                    <td>' . $req_id . '</td>
                                                    <td>' . $category_name . '</td>
                                                <td class="text-bold-500">' . $category_name . '</td>
                                                <td>' . $category_description . '</td>
                                                <td>' . $created_at . '</td>
                                                <td>
                                                <a href="./edit_package.php?pack_id=' . $req_id . '"><button class="btn icon btn-info">Edit</button></a>
                                                <button hx-get="./helpers/delete_package.php?req_id=' . $req_id . '" hx-trigger="click" hx-target="#notify" class="btn icon btn-danger">Delete</button>
                                                </td>
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
                <!--End Dashboard Content-->

                <!--start overlay-->
                <div class="overlay toggle-menu"></div>
                <!--end overlay-->

            </div>
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <?php include('./components/footer.php') ?>