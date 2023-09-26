<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
    <a href="index.html">
      <!-- <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> -->
      <h5 class="logo-text">MyFame</h5>
    </a>
  </div>
  <ul class="sidebar-menu do-nicescrol">
    <li class="sidebar-header">MAIN NAVIGATION</li>
    <?php
    if ($user_type == 'admin') {
    ?>
      <li>
        <a href="review_funds.php">
          <i class="zmdi zmdi-grid"></i> <span>Review Funds</span>
          <small class="badge float-right badge-light"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM wallet WHERE status = 'pending'")) ?></small>
        </a>
      </li>

      <li>
        <a href="review_orders.php">
          <i class="zmdi zmdi-calendar-check"></i> <span>Review Order</span>
          <small class="badge float-right badge-light"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE status = '0'")) ?></small>
        </a>
      </li>

      <li>
        <a href="review_widthrawl.php">
          <i class="zmdi zmdi-calendar-check"></i> <span>Review Widthrawl Request</span>
          <small class="badge float-right badge-light"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM widthrawl_request WHERE status = '0'")) ?></small>
        </a>
      </li>

      
      <li>
        <a href="add_package.php">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Add Package</span>
        </a>
      </li>
      <li>
        <a href="view_categories.php">
          <i class="zmdi zmdi-face"></i> <span>View Category</span>
        </a>
      </li>
      <li>
        <a href="view_package.php">
          <i class="zmdi zmdi-account-circle"></i> <span>View Package</span>
        </a>
      </li>
    <?php
    } else if ($user_type == 'user') {
    ?>
      <li>
        <a href="index.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Add Funds</span>
        </a>
      </li>

      <li>
        <a href="add_order.php">
          <i class="zmdi zmdi-invert-colors"></i> <span>Add Order</span>
        </a>
      </li>
      <li>
        <a href="view_funds.php">
          <i class="zmdi zmdi-lock"></i> <span>View Funds</span>
        </a>
      </li>

      <li>
        <a href="view_orders.php">
          <i class="zmdi zmdi-account-circle"></i> <span>View Orders</span>
        </a>
      </li>

      <li>
        <a href="view_refral.php">
          <i class="zmdi zmdi-account-circle"></i> <span>Referral Amount</span>
        </a>
      </li>

      <li>
        <a href="./add_request.php">
          <i class="zmdi zmdi-account-circle"></i> <span>Widthrawl Request</span>
        </a>
      </li>

      <li>
        <a href="./view_widthrawl.php">
          <i class="zmdi zmdi-account-circle"></i> <span>View Widthrawl Requests</span>
        </a>
      </li>
    <?php
    }
    ?>









  </ul>

</div>