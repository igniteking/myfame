<?php
include("../connections/connection.php");
include("../connections/global.php");
include("../connections/functions.php");
$req_id = $_GET['req_id'];
$status = $_GET['status'];
$amount = $_GET['amount'];
$get_user_id = $_GET['get_user_id'];
if ($status == 'accept') {
    $accept = mysqli_query($conn, "UPDATE `wallet` SET `status`='success' WHERE id = '$req_id'");
    $past_amount = fetch_single_row($conn, "SELECT amount FROM `main_wallet` WHERE user_id = '$get_user_id'");
    $total = $past_amount + $amount;
    $accept = mysqli_query($conn, "UPDATE `main_wallet` SET `amount`='$total' WHERE user_id = '$get_user_id'");

    if ($accept) {
        Toast('success', 'Funds Accepted ...');
        echo "<meta http-equiv=\"refresh\" content=\"2; url=./review_funds.php\">";
    } else {
        Toast('danger', 'ERROR  ...');
    }
} else {
    $delete = mysqli_query($conn, "UPDATE `wallet` SET `status`='rejected' WHERE id = '$req_id'");
    if ($delete) {
        Toast('success', 'Funds Rejected ...');
        echo "<meta http-equiv=\"refresh\" content=\"2; url=./review_funds.php\">";
    } else {
        Toast('danger', 'ERROR  ...');
    }
}
