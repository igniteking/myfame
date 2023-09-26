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
        <div class="row">
          <div class="col-md-8">
            <div class="card mt-3">
              <div class="card-body">
                <div class="card-header">
                  <h2>Welcome <?= $username ?> <br> to MyFame</h2><br>
                </div>
                <div class="row mb-4">
                  <div class="col-md-8">
                    <input type="text" id="copytext" class="form-control" disabled value="http://localhost/myfame/auth/register.php?code=<?= $mycode; ?>">
                  </div>
                  <div class="col-md-4">
                    <input type="button" onclick="copyCode()" value="Click Here To Copy Code" class="form-control" id="">
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12">
                <div class="card mt-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="col-md-12 btn btn-transperent text-white form-control" style="height: 70px;">
                          <i class="fa fa-user" style="font-size: 50px;"></i>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <h3>
                          <?= $username ?>
                        </h3>
                        <h6>Your Username</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card mt-2">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="col-md-12 btn btn-transperent text-white form-control" style="height: 70px;">
                          <i class="fa fa-money" style="font-size: 50px;"></i>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <h3>
                          ₹<?= fetch_single_row($conn, "SELECT amount from main_wallet WHERE user_id = '$user_id'"); ?>
                        </h3>
                        <h6>Your Account Balance</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="card col-md-12">
            <div class="card-content">
              <div class="card-body">
                <div class="card-heading">Minimum recharge is Rs 10</div>
                <hr>
                <div class="card-heading">After completing total recharge of Rs500 You will get 20% extra fund.</div>
              </div>
              <center>
                <a href="./view_orders.php">
                  <div class="card-footer">View Your Orders</div>
                </a>
              </center>
            </div>
          </div>
        </div>
        <!--Start Dashboard Content-->

        <script>
          function copyCode() {
            var box = document.getElementById('copytext');
            navigator.clipboard.writeText(box.value);
            Toastify({
              text: 'Link Copied ...',
              duration: 3000,
              close: true,
              gravity: 'top',
              position: 'center',
              stopOnFocus: true, // Prevents dismissing of toast on hover
              backgroundColor: '#a2d2ff',
              onClick: function() {} // Callback after click
            }).showToast();
          }
        </script>
        <div class="page-content">
          <section class="h-100 gradient-custom-2">
            <div class="h-100">
              <div class="row d-flex justify-content-center h-100">

                <div class="col-md-6 col-12">
                  <div class="card">
                    <?php
                    if (@$_GET['code'] == 3) {
                      Toast(
                        "success",
                        "Order Created Succesfully ..."
                      );
                    }
                    $add_order = @$_POST['add_order'];
                    if ($add_order) {
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
                          echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.php?code=3\">";
                        }
                      } else {
                        Toast(
                          "warning",
                          "Insufficient Funds  ..."
                        );
                      }
                    }


                    ?>
                    <div class="card-header">
                      <h4 class="card-title">Add Order</h4>
                    </div>
                    <div class="card-content">
                      <div class="card-body">
                        <form class="form form-horizontal" method="post" action="./index.php">
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
                                <div id="options"></div>
                                <script>
                                  function calculate(quantity) {
                                    var amount = (document.getElementById('amount').value);
                                    var total = amount * quantity;
                                    console.log(total);
                                    console.log(amount);
                                    document.getElementById('total_price').value = total;
                                  }
                                </script>
                              </div><br>
                              <div class="col-md-12">
                                <label>Total Price</label>
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="form-group">
                                  <div class="position-relative">
                                    <input type="text" disabled class="form-control" id="total_price" name="total_price">
                                  </div>
                                </div>
                              </div><br>
                              <div class="col-md-12">
                                <label>Link</label>
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="form-group">
                                  <div class="position-relative">
                                    <input type="url" class="form-control" name="link">
                                  </div>
                                </div>
                              </div><br>
                              <div class="col-12 d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary me-1 mb-1" name="add_order" value="Submit"></input>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1 text-white">Reset</button>
                              </div><br>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Add Funds</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <?php
                      $reg = @$_POST['request'];
                      if ($reg) {
                        $amount = security_check(@$_POST['amount']);
                        $reference_id = security_check(@$_POST['reference_id']);
                        $created_at = date("Y-m-d H:i:s");
                        $insert_request = mysqli_query($conn, "INSERT INTO `wallet`(`id`, `amount`, `reference_id`, `user_id`, `created_at`, `status`) VALUES 
                                            (NULL,'$amount','$reference_id','$user_id','$created_at', 'pending')");

                        if ($insert_request) {
                          echo "<meta http-equiv=\"refresh\" content=\"0; url=./index.php?code=1\">";
                        }
                      }
                      if (@$_GET['code'] == 1) {
                        Toast(
                          "success",
                          "Requested Recharge .."
                        );
                      }

                      if (@$_GET['login'] == 1) {
                        Toast(
                          "success",
                          "Login Successfull .."
                        );
                      }

                      ?>
                      <form class="form form-horizontal" method="post" action="./index.php" enctype="multipart/form-data">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-4">
                              <label>Amount</label>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <div class="position-relative">
                                  <input type="number" class="form-control" name="amount" placeholder="Amount" id="first-name-icon">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <label>Reference Id</label>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                <div class="position-relative">
                                  <input type="text" class="form-control" name="reference_id" placeholder="Reference Id" id="first-name-icon">
                                </div>
                              </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                              <input type="submit" class="btn btn-primary me-1 mb-1" name="request" value="Submit"></input>
                              <button type="reset" class="btn btn-light-secondary me-1 mb-1 text-white">Reset</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <img src="https://assetscdn1.paytm.com/images/catalog/product/F/FU/FULLAMINATED-PAOCL-870346F991C1DE/1661943487574_20.jpg" class="img img-responsive" alt="">
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