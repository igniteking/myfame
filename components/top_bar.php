<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="icon-menu menu-icon"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
            <li class="nav-item dropdown-lg">
                Account Wallet : <?= fetch_single_row($conn, "SELECT amount from main_wallet WHERE user_id = '$user_id'"); ?>
            </li>
            <li class="nav-item dropdown-lg ml-4">
                Referal Wallet : <?= fetch_single_row($conn, "SELECT amount from refral_wallet WHERE user_id = '$user_id'"); ?>

            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
                                <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                                <div class="media-body">
                                    <h6 class="mt-2 user-title"><?= $username ?></h6>
                                    <p class="user-subtitle"><?= $email ?></p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <a href="./index.php">
                        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Add Funds</li>
                    </a>
                    <li class="dropdown-divider"></li>
                    <a href="./helpers/logout.php">
                        <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
                    </a>
                </ul>
            </li>
        </ul>
    </nav>
</header>