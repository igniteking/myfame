<?php
include("../connections/connection.php");
include("../connections/global.php");
include("../connections/functions.php");
$req_id = $_GET['req_id'];
$status = $_GET['status'];
$amount = @$_GET['amount'];
$get_user_id = @$_GET['get_user_id'];
$code = @$_GET['code'];
if ($status == 'accept') {
    if ($code == '') {
        $accept = mysqli_query($conn, "UPDATE `orders` SET `status`='1' WHERE id = '$req_id'");
    } else {
        $reward = $_GET['reward'];
        $created_at = date('Y-m-d H:i:s');
        $accept1 = mysqli_query($conn, "UPDATE `orders` SET `status`='1' WHERE id = '$req_id'");
        $fetch_code_id = fetch_single_row($conn, "SELECT id FROM `user_data` WHERE `mycode` = '$code'");
        $accept = mysqli_query($conn, "INSERT INTO `wallet`(`id`, `amount`, `user_id`, `created_at`, `status`) VALUES
        (NULL,'$reward','$fetch_code_id','$created_at', 'bonus')");
        $fetch_main_wallet = fetch_single_row($conn, "SELECT amount FROM `refral_wallet` WHERE `user_id` = '$fetch_code_id'");
        $tota = $reward + $fetch_main_wallet;
        $delete_wallet = mysqli_query($conn, "UPDATE `refral_wallet` SET `amount`='$tota' WHERE user_id = '$fetch_code_id'");
    }
    if ($accept) {
        Toast('success', 'Order Accepted ...');
        echo "<meta http-equiv=\"refresh\" content=\"2; url=./review_orders.php\">";
    } else {
        Toast('danger', 'ERROR  ...');
    }
} else {
    $delete = mysqli_query($conn, "UPDATE `orders` SET `status`='2'WHERE id = '$req_id'");
    $fetch_main_wallet = fetch_single_row($conn, "SELECT amount FROM `main_wallet` WHERE `user_id` = '$get_user_id'");
    $tota = $amount + $fetch_main_wallet;
    $delete_wallet = mysqli_query($conn, "UPDATE `main_wallet` SET `amount`='$tota' WHERE user_id = '$get_user_id'");
    if ($delete_wallet) {
        Toast('success', 'Order Rejected ...');
        echo "<meta http-equiv=\"refresh\" content=\"2; url=./review_orders.php\">";
    } else {
        Toast('danger', 'ERROR  ...');
    }
}
