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
    $accept = mysqli_query($conn, "UPDATE `widthrawl_request` SET `status`='completed' WHERE id = '$req_id'");
    if ($accept) {
        Toast('success', 'Order Accepted ...');
        echo "<meta http-equiv=\"refresh\" content=\"2; url=./review_orders.php\">";
    } else {
        Toast('danger', 'ERROR  ...');
    }
} else {
    $delete = mysqli_query($conn, "UPDATE `widthrawl_request` SET `status`='rejected'WHERE id = '$req_id'");
    if ($delete) {
        Toast('success', 'Order Rejected ...');
        echo "<meta http-equiv=\"refresh\" content=\"2; url=./review_orders.php\">";
    } else {
        Toast('danger', 'ERROR  ...');
    }
}
