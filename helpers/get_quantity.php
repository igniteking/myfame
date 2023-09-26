<?php
include("../connections/connection.php");
include("../connections/global.php");
include("../connections/functions.php");
$get_id = $_GET['package_id'];
if ($get_id != "") {

    $get_amount = mysqli_query($conn, "SELECT * FROM `package` WHERE `package_name` = '$get_id'");
    while ($rows = mysqli_fetch_array($get_amount)) {
        $amount = $rows["amount"];
        echo '
        <input type="hidden" id="amount" name="amount" value="' . $amount . '" />
        ';
    }
}
